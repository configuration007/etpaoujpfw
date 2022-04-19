$(function () {
    function getPrices() {
        const url = '/api/get-prices'
        axios.get(url)
            .then(function ({ data }) {
                const arr = data.data;
                for (var key in arr) {
                    const id = "#" + key + "_val_price";
                    const rate_class = arr[key].rate > 0 ? '_is_successful' : '_is_failed';
                    if ($(id).length) {
                        const inner = `<span class="dollar_sign">$</span><b>${arr[key].amount} <span class="${rate_class}">${arr[key].rate}%</span></b> `
                        $(id).html(inner)
                    }
                }
            })
            .catch(function (error) {

            })
    }

    setInterval(function () {
        getPrices()
    }, 50000);

    window.onload(getPrices())
})