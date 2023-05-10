# bor

## Требование

* PHP 8.0 or higher
* Composer for installation

```console
composer install
```

## Webpack 

Для генерации css и js запустите:
```console
npx wp
```

## Создадим проект
Для работы с БД используется doctrine

Давайте создадим сущность и из нее сгенерируем таблицу в бд:

в папке entity
```php
<?php
namespace entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'products')]
class Product
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: 'string')]
    private string $name;

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

}
```

за тем запустим миграцию:

```console
php doctrine orm:schema-tool:update --force
```

## Прописание роутов

в файле config/router.php
```php
SimpleRouter::get('/', 'SiteController@index', ['as' => 'home']);
SimpleRouter::get('/index/{page}', 'SiteController@index', ['as' => 'home.page']);
SimpleRouter::get('create', 'SiteController@create', ['as' => 'create']);
SimpleRouter::post('store', 'SiteController@store', ['as' => 'store']);
SimpleRouter::get('update/([0-9]+)', 'SiteController@index', ['as' => 'update']);
```

## Создание контроллера

в папке controllers создадим SiteController.php
```php
<?php
namespace controllers;

use bor\Auth;
use bor\Controller;
use bor\DB;
use Doctrine\ORM\Tools\Pagination\Paginator;
use entity\Product;
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

}
```

## Создание правил валидации

в папке validator создадим SiteValidator.php

```php
<?php
namespace validator;

use bor\Validator;

Class SiteValidator extends Validator
{
    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }
}
```

## Вид
шаблон для создание товаров view/site/create.tpl.php
```php
<?php
    $view->setTitle('Добавить продукт');
?>
<h2>Добавить продукт</h2>


<form method="post" action="<?=$view->url('store');?>">
    <div class="mb-3">
        <label for="name" class="form-label">Название</label>
        <input type="text" name="name" class="form-control" id="name" value="<?=$view->old('name')?>" >
        <?if($errors->first('name')):?>
            <span role="alert">
              <strong><?=$errors->first('name')?></strong>
            </span>
        <?endif;?>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
```