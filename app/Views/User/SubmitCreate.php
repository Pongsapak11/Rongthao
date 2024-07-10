<script>
    <?php if ($error): ?>
        Swal.fire({
            title: "เพิ่มผู้ใช้งานไม่สำเร็จ",
            text: "<?= $message ?>",
            icon: "error"
        }).then(function() {
            window.location.href = "<?= base_url() ?>user/create";
        });
    <?php else: ?>
        Swal.fire({
            title: "เพิ่มผู้ใช้งานสำเร็จ!",
            text: "<?= $message ?>",
            icon: "success"
        }).then(function() {
            window.location.href = "<?= base_url() ?>user";
        });
    <?php endif; ?>
</script>