/**
 * Select2 Indonesian translation.
 * 
 * Author: Isnu Suntoro <isnusun@gmail.com>
 * Author: Ibrahim Yusuf <ibrahim7usuf@gmail.com>
 * Author: Salahuddin Hairai <mr.od3n@gmail.com>
 */
(function ($) {
    "use strict";

    $.fn.select2.locales['id'] = {
        formatMatches: function (matches) { if (matches === 1) { return "Ditemukan satu hasil, tekan enter untuk memilih."; } return "Ditemukan "+ matches + " hasil, gunakan tombol anak panah ke atas dan ke bawah untuk menavigasi."; },
        formatNoMatches: function () { return "Tidak ada data yang sesuai"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "Masukkan " + n + " huruf lagi"; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "Hapuskan " + n + " huruf" ; },
        formatSelectionTooBig: function (limit) { return "Anda hanya dapat memilih " + limit + " pilihan"; },
        formatLoadMore: function (pageNumber) { return "Mengambil data…"; },
        formatSearching: function () { return "Mencari…"; }
    };

    $.extend($.fn.select2.defaults, $.fn.select2.locales['id']);
})(jQuery);
