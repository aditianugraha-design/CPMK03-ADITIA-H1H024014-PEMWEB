    </div><!-- /content-area -->
</div><!-- /main-content -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto-dismiss alerts after 4s
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(a => {
            let alert = new bootstrap.Alert(a);
            alert.close();
        });
    }, 4000);
</script>
</body>
</html>
