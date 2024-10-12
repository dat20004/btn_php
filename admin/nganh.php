<?php include 'header.php' ?>
<div class="content-wrapper">
    <div class="container">
        <div class="major-admin">
            <div class="major-admin__header">
                <h1>Ngành</h1>
                <a href="add-major.php" class="btn btn-primary">Tạo ngành mới</a>
            </div>
            <div class="major-admin__search">
                <form action="" method="POST" role="form">
                    <div class="form-group">
                        <input type="text" placeholder="Nhập tên ngành">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            <div class="major-admin__list">
                <h1>Danh sách</h1>
                <div class="major-admin__item">
                    <div class="major-admin__img"><img src="./dist/img/avatar2.png" alt=""></div>
                    <p class="major-admin__name">Ngoại ngữ</p>
                    <p class="major-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus vitae
                        minus dolores, est voluptatibus omnis odio doloribus dignissimos magnam porro.</p>
                    <div class="major-admin__button">
                        <a href="edit-major.php" class="btn btn-primary">Sửa</a>
                        <a href="" class="btn btn-danger">Xóa</a>
                    </div>
                </div>
                <div class="major-admin__item">
                    <div class="major-admin__img"><img src="./dist/img/avatar2.png" alt=""></div>
                    <p class="major-admin__name">Ngoại ngữ</p>
                    <p class="major-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus vitae
                        minus dolores, est voluptatibus omnis odio doloribus dignissimos magnam porro.</p>
                    <div class="major-admin__button">
                        <a href="edit-major.php" class="btn btn-primary">Sửa</a>
                        <a href="" class="btn btn-danger">Xóa</a>
                    </div>
                </div>
                <div class="major-admin__item">
                    <div class="major-admin__img"><img src="./dist/img/avatar2.png" alt=""></div>
                    <p class="major-admin__name">Ngoại ngữ</p>
                    <p class="major-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus vitae
                        minus dolores, est voluptatibus omnis odio doloribus dignissimos magnam porro.</p>
                    <div class="major-admin__button">
                        <a href="edit-major.php" class="btn btn-primary">Sửa</a>
                        <a href="" class="btn btn-danger">Xóa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>