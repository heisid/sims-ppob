<script>
    const realBalance = "Rp <?= number_format(session()->get('balance'), 0, ',', '.') ?>"
    let isVisible = false

    function toggleBalance() {
        if (isVisible) {
            $("#balanceAmount").text("Rp ••••••••")
            $("#toggleIcon").removeClass("fa-eye-slash").addClass("fa-eye")
            isVisible = false
        } else {
            $("#balanceAmount").text(realBalance);
            $("#toggleIcon").removeClass("fa-eye").addClass("fa-eye-slash")
            isVisible = true
        }
    }

    $(document).ready(function() {
        $(".toggleBalance").on("click", toggleBalance)
        $("#profile-image").on("error", function () {
            $(this).attr("src", "/img/Profile Photo.png")
        })
    })
</script>