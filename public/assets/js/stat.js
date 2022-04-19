$(function () {
    function getPrices() {
        const url = "/api/get-prices-stat";
        axios
            .get(url)
            .then(function ({ data }) {
                const arr = data.data;
                let ola = `
                <thead class="hMlCUD">
                <tr>
                        <th class="fkeFpt">Asset</th>
                        <th class="fkeFpt">Last mine</th>
                        <th class="fkeFpt">24 %</th>
                        <th class="fkeFpt">24h change</th>
                </tr>
                </thead>`;
                for (var key in arr) {
                    ola =
                        ola +
                        `
                <tr class="edcsxas">
                    <td class="baseAXSD">
                        <div class="ieuAS">
                            <img src="${arr[key].image}" alt="">
                            <p class="aXEadd">${arr[key].symbol}/USD</p>
                        </div>
                    </td>
                    <td class="baseAXSD">${arr[key].amount}</td>
                    <td class="baseAXSD">${arr[key].rate}</td>
                    <td class="baseAXSD">${arr[key].extra}</td>
                </tr>
                `;
                }
                $("#aBaewsa").html(ola);
            })
            .catch(function (error) {});
    }

    setInterval(function () {
        getPrices();
    }, 50000);

    getPrices();
});
