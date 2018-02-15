<aside class="main-sidebar">

    <section class="sidebar">
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'Вхідні дані', 'icon' => 'download', 'url' => ['/main/index']],
                    ['label' => 'Реклама', 'icon' => 'file', 'url' => ['/advertising/index']],
                    [
                        'label' => 'Вихідні дані',
                        'icon' => 'upload',
                        'url' => '#',
                        'items' => [
                            ['label' => 'По типу мовлення', 'icon' => 'tasks', 'url' => ['/report-out/speech'],],
                            ['label' => 'По жанру', 'icon' => 'tasks', 'url' => ['/report-out/genre'],],
                            ['label' => 'Мікрофонна папка', 'icon' => 'tasks', 'url' => ['/report-out/microphone'],],
                            ['label' => 'Облік мовлення', 'icon' => 'tasks', 'url' => ['/report-out/broadcast'],],
                        ],
                    ],
                    [
                        'label' => 'Настройки',
                        'icon' => 'cog',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Код', 'icon' => 'tasks', 'url' => ['/code/index'],],
                            ['label' => 'Шаблон', 'icon' => 'tasks', 'url' => ['/template/index'],],
                            ['label' => 'Види мовлення', 'icon' => 'tasks', 'url' => ['/speech/index'],],
                            ['label' => 'Види жанрів', 'icon' => 'tasks', 'url' => ['/genre/index'],],
                            ['label' => 'Назв передач', 'icon' => 'tasks', 'url' => ['/telecast/index'],],
                        ],
                    ],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],
            ]
        ) ?>

    </section>

</aside>
