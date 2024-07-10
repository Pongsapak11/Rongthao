<script>
    <?php if ($error): ?>
        Swal.fire({
            title: "เพิ่มสินค้าไม่สำเร็จ",
            text: "<?= $message ?>",
            icon: "error"
        }).then(function() {
            window.location.href = "<?= base_url() ?>product/create";
        });
    <?php else: ?>
        Swal.fire({
            title: "เพิ่มสินค้าสำเร็จ!",
            text: "<?= $message ?>",
            icon: "success"
        }).then(function() {
            window.location.href = "<?= base_url() ?>product";
        });
    <?php endif; ?>
</script>