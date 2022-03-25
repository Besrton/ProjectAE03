(function($, window) {

    /* Comptador antic
    $('.countdown').each(function() {

        let counter = $(this);        
        let date = counter.text().split(':');
        let timer = date[0] * 86400 + date[1] * 3600 + date[2] * 60 + date[3] * 1;

        console.log('old' + timer);

        let coutdown = setInterval(function() {

            let d = Math.floor(timer / (3600*24));
            let h = Math.floor(timer % (3600*24) / 3600);
            let m = Math.floor(timer % 3600 / 60);
            let s = Math.floor(timer % 60);

            counter.text(d + ':' + h + ':'  + m + ':' + s);

            if (--timer < 0) {
                clearInterval(coutdown);
                counter.text('Nou episodi!');
                //console.log("Expired");
            }

        }, 1000);

    });
    */

    // Comptadors
    $('[data-countdown]').each(function() {

        let counter = $(this);
        let timer = counter.data('countdown');//date[0] * 86400 + date[1] * 3600 + date[2] * 60 + date[3] * 1;

        let coutdown = setInterval(function() {

            let d = Math.floor(timer / (3600*24));
            let h = Math.floor(timer % (3600*24) / 3600);
            let m = Math.floor(timer % 3600 / 60);
            let s = Math.floor(timer % 60);

            counter.text(d + ' days ' + h + ' hours '  + m + ' minutes ' + s + ' seconds');

            if (--timer < 0) {
                clearInterval(coutdown);
                counter.text('Nou episodi!');
                //console.log("Expired");
            }

        }, 1000);

    });

})(jQuery, window);