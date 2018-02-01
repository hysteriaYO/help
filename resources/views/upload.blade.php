<form method="post" enctype="multipart/form-data" action="">
{{ csrf_field() }}
    <label for="file">选择文件</label>
    <input type="file" name="file">
    <button type="submit">上传</button>
</form>