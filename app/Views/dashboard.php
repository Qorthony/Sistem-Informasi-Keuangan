<?= $this->extend('layout/app_layout.php') ?>

<!-- Menu Sidebar -->
<?= $this->section('sidebar-menu') ?>
<li class="menu-item-has-children active">
    <a href="/"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
</li>
<li class="menu-item-has-children">
    <a href="/user"> <i class="menu-icon fa fa-cogs"></i>Data User</a>
</li>
<?= $this->endSection('sidebar-menu') ?>

<?= $this->section('content') ?>
<!-- End Menu Sidebar -->

<?= $this->section('content') ?>
<h1 class="content-title">Dashboard</h1>
<div class="row pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h1>Ini Halaman Dashboard</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut accusamus provident, porro cum, obcaecati culpa officiis, ipsa nostrum quis laborum incidunt totam. Veniam voluptate nesciunt dolores mollitia quas sunt quasi!
                Unde assumenda perspiciatis nobis neque quo non temporibus suscipit veniam architecto laudantium quae quas id dicta, provident labore, iusto hic velit, eum eius corrupti? Dolores et quos sapiente expedita aspernatur!
                Illum, impedit eius mollitia necessitatibus sed accusamus accusantium ex earum nobis ipsa, nihil porro? Sed reiciendis adipisci perferendis modi odit, aspernatur voluptatibus incidunt nulla, distinctio, natus maiores culpa molestiae neque!
                Neque nobis commodi voluptates fugit temporibus. Perferendis enim molestias quasi quis ex blanditiis excepturi quo, distinctio minima nam provident, commodi sapiente, mollitia ipsa! Architecto et veritatis enim corrupti sit asperiores.
                Tempora suscipit consectetur earum quibusdam sunt omnis qui iste quas numquam? Totam dignissimos beatae voluptas facilis reprehenderit quos aut eum quis asperiores deleniti, ab qui. Sed, dolore magnam! Hic, itaque!
                Quis quisquam consequatur ipsam ex numquam, voluptate, soluta eaque optio facilis, illum fuga eligendi nesciunt aspernatur sit! Ea a expedita blanditiis odio quia error ratione asperiores! Aliquid aut impedit id!
                Ullam sequi voluptas error fuga quaerat praesentium voluptatibus quo? Repellat suscipit, cumque reiciendis corporis iure labore ut eos similique magnam ipsum vel excepturi! Optio, accusantium libero neque corporis vel dolore.
                Provident veniam laudantium porro. Consequuntur accusamus dicta repellendus harum deleniti minima modi, ullam quibusdam sit repudiandae quaerat quas, tenetur repellat aut laborum earum molestias officiis. Porro, a. Earum, facere laboriosam?
                Itaque sed voluptatibus fugiat magnam quam mollitia suscipit, quia vel repudiandae tenetur, eum, doloribus rem ab molestias dicta asperiores saepe id inventore reiciendis maiores autem! Accusantium doloribus dolorum quod laborum!
                Possimus quibusdam dolorem optio, officiis aliquam a id molestias sunt, at ad reprehenderit ullam inventore. Corporis ex totam, nobis quis assumenda laboriosam placeat. Ullam aliquam distinctio ratione modi possimus unde.</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>