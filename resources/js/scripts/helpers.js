import Vue from 'vue'

export const isEmpty = (data) => {
    return data == null || data == "" || data == " " || data == [];
}

export const isAuthorized = (user, next) => {
    switch (user) {
        case ('client'):
            if (!isEmpty(localStorage.getItem('client_token'))) { return next(); } else {
                return window.location.href = '/login'
            }
        case ('admin'): if (!isEmpty(localStorage.getItem('admin_token'))) { return next(); } else {
            return window.location.href = '/unauthorized'
        }
        default: window.location.href = '/'

    }
    return next();
}

Vue.filter("dateChange", function (value) {
    return moment(value).format("MMMM Do YYYY");
});

Vue.filter("timeChange", function (value) {
    return moment(value).format("hh mm ss a");
});

Vue.filter("smartChange", function (value) {
    var today = new Date();
    if (moment(today).isSame(value, 'day')) {
        return moment(value).format("hh:mm a");
    } else if (moment(today).isSame(value, 'year')) {
        return moment(value).format(" Do MMM");
    }
    else {
        return moment(value).format(" Do MMM YY");
    }
});

Vue.filter("smartChange_full", function (value) {
    var today = new Date();
    if (moment(today).isSame(value, 'day')) {
        return moment(value).format("hh:mm a");
    } else {
        return moment(value).format(" Do MMM");
    }
});

Vue.filter("upperFirst", function (value) {
    if (value) {
        var firstLetter = value.substr(0, 1);
        return firstLetter.toUpperCase() + value.substr(1);
    }
    return 'Nill'
});

Vue.filter("addComma", function (num) {
    var output = num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    if (isNaN(output)) {
        return output
    } else {
        return output;
    }
})

Vue.filter("removeComma", function (num) {
    var characters = parseInt(num, 10).toString();
    var output = '';
    for (var offset = characters.length; offset > 0; offset -= 3) {
        output = characters.slice(Math.max(offset - 3, 0), offset) + (output ? '' + output : ',');
    }
    if (isNaN(output)) {
        return 0.00
    } else {
        return output;
    }
})

Vue.filter("isEmpty", function (data) {
    return data == null || data == "" || data == " " || data == [];
})