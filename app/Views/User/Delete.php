<script>
    <?php if ($error): ?>
        Swal.fire({
            title: "ลบผู้ใช้งานไม่สำเร็จ",
            text: "<?= $message ?>",
            icon: "error"
        }).then(function() {
            window.location.href = "<?= base_url() ?>user";
        });
    <?php else: ?>
        Swal.fire({
            title: "ลบผู้ใช้งานสำเร็จ!",
            text: "<?= $message ?>",
            icon: "success"
        }).then(function() {
            window.location.href = "<?= base_url() ?>user";
        });
    <?php endif; ?>
</script>