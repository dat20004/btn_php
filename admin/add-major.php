<?php include 'header.php' ?>
<div class="content-wrapper">
    <div class="container">
        <div class="edit-major__center">
            <div class="edit-major">
                <h1>Tạo ngành mới</h1>
                <div class="form-group">
                    <label for="major-name">Tên ngành</label>
                    <input type="text" id="major-name" placeholder="Nhập tên ngành" />
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea id="description" rows="4" placeholder="Nhập mô tả ngành"></textarea>
                </div>
                <div class="form-group">
                    <label for="upload-image">Hình ảnh</label>
                    <div class="file-input">
                        <button class="upload-button" id="upload-image">
                            Tải ảnh lên
                        </button>
                        <input type="file" id="file-upload" accept="image/*" />
                    </div>
                </div>
                <button class="submit-button">Tạo</button>
            </div>
        </div>

    </div>
</div>
<?php include 'footer.php' ?>