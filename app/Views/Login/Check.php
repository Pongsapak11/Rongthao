<script>
    <?php if ($error): ?>
        Swal.fire({
            title: "ล็อกอินไม่สำเร็จ",
            text: "<?= $message ?>",
            icon: "error"
        }).then(function() {
            window.location.href = "<?= base_url() ?>login";
        });
    <?php else: ?>
        Swal.fire({
            title: "ล็อกอินสำเร็จ!",
            text: "<?= $message ?>",
            icon: "success"
        }).then(function() {
            window.location.href = "<?= base_url() ?>";
        });
    <?php endif; ?>
</script>