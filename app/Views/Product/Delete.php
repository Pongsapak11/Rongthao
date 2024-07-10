<script>
    <?php if ($error): ?>
        Swal.fire({
            title: "ลบสินค้าไม่สำเร็จ",
            text: "<?= $message ?>",
            icon: "error"
        }).then(function() {
            window.location.href = "<?= base_url() ?>product";
        });
    <?php else: ?>
        Swal.fire({
            title: "ลบสินค้าสำเร็จ!",
            text: "<?= $message ?>",
            icon: "success"
        }).then(function() {
            window.location.href = "<?= base_url() ?>product";
        });
    <?php endif; ?>
</script>