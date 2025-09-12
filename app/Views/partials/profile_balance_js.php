<script>
    let updateBalanceHeader

    $(document).ready(function() {
        let realBalance = "Rp <?= number_format(session()->get('balance'), 0, ',', '.') ?>"
        let isVisible = false
        const toggleBalanceBtn = $(".toggleBalance")
        const profileImage = $("#profile-img")
        const balanceAmountText = $("#balanceAmount")
        const eyeIcon = $("#toggleIcon")

        toggleBalanceBtn.on("click", function () {
            if (isVisible) {
                balanceAmountText.text("Rp ••••••••")
                eyeIcon.removeClass("fa-eye-slash").addClass("fa-eye")
                isVisible = false
            } else {
                balanceAmountText.text(realBalance);
                eyeIcon.removeClass("fa-eye").addClass("fa-eye-slash")
                isVisible = true
            }
        })
        profileImage.on("error", function () {
            $(this).attr("src", "/img/Profile Photo.png")
        })

        updateBalanceHeader = (newBalance = null) => {
            if (newBalance) realBalance = `Rp ${newBalance.toLocaleString("id-ID")}`
            else {
                $.ajax({
                    url: "/transaction/fetch-balance",
                    success: function (response) {
                        realBalance = `Rp ${response.balance.toLocaleString("id-ID")}`
                    }
                })
            }
            if (isVisible) balanceAmountText.text(realBalance)
        }
    })
</script>