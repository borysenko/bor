<?php
namespace controllers;
include_once '../bor/Helper.php';
use bor\Auth;
use bor\Controller;
use bor\DB;
use Doctrine\ORM\Tools\Pagination\Paginator;
use entity\Product;
use entity\User;
use Rakit\Validation\Rule;
use Rakit\Validation\Validator;
use validator\LoginValidator;
use validator\SiteValidator;
use Pecee\Http\Url;


Class SiteController extends Controller {

    public function index($page = 1)
    {
        $productRepository = DB::$entityManager->getRepository(Product::class);
        $query = $productRepository->createQueryBuilder('p');

        $paginator = (new \bor\Paginator())->paginate($query, $page);
        return $this->render('site/index', [
            'paginator' => $paginator
        ]);
    }

    public function store()
    {
        $validator = new SiteValidator();
        $validation = $validator->validate();
        if (!$validation->fails()) {

            $product = new Product();
            $product->setName(input()->post('name'));
            DB::entityManager()->persist($product);
            DB::entityManager()->flush();

            return $this->route('home')->redirect();

        } else {
            $errors = $validation->errors();
            return $this->errors($errors)
                ->route('create')
                ->redirect();
        }

    }

    public function create()
    {
        return $this->render('site/create');
    }

    public function showLoginForm()
    {
        return $this->render('site/login');
    }

    public function logout()
    {
        Auth::logout();
        return $this->route('home')->redirect();
    }

    public function login()
    {
        $validator = new LoginValidator();
        $validation = $validator->validate();
        if (!$validation->fails()) {

            $user = DB::entityManager()->getRepository(User::class)->findOneBy(['username' => input()->post('username')]);
            Auth::login($user);

            return $this->route('home')->redirect();

        } else {
            $errors = $validation->errors();
            return $this->errors($errors)
                ->route('login')
                ->redirect();
        }
    }

    public function showSignupForm()
    {
        return $this->render('site/signup');
    }

    public function signup()
    {
        $validator = new Validator();
        $validation = $validator->make($_POST, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $validation->validate();
        if (!$validation->fails()) {

            $user = new User();
            $user->setUsername(input()->post('username'));
            $user->setPassword(input()->post('password'));
            $user->generateToken();
            DB::entityManager()->persist($user);
            DB::entityManager()->flush();

            return $this->route('login')->redirect();

        } else {
            $errors = $validation->errors();
            return $this->errors($errors)
                ->route('signup')
                ->redirect();
        }
    }

    public function forbidden()
    {
        return $this->render('site/forbidden');
    }

    public function notFound()
    {
        return $this->render('site/not-found');
    }
}