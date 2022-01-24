<!-- Bootstrap core JavaScript-->
<script type="text/javascript">
    function updateNotification() {
        document.getElementById('notification_number').innerText = '';
        $.get("/notification/readed");
    }
    function checkDarkMode(){
        if ((localStorage.getItem('mode') || 'dark') === 'dark'){
            displayDarkMode()
        }
    }
    function setDarkMode() {
        localStorage.setItem('inphibit-mode', (localStorage.getItem('inphibit-mode') || 'dark') === 'dark' ? 'light' : 'dark');
        displayDarkMode();
    }
    function displayDarkMode() {
        if(localStorage.getItem('inphibit-mode') === 'dark'){
            document.querySelector('body').classList.add('dark')
            document.querySelector('nav').classList.add('dark')
            document.querySelector('footer').classList.add('dark')
            document.getElementById('accordionSidebar').classList.add('dark')
            document.getElementById('content').classList.add('dark')

            document.querySelector('nav').classList.remove('bg-white')
            document.querySelector('footer').classList.remove('bg-white')
            document.getElementById('accordionSidebar').classList.remove('bg-gradient-primary')
        }else{
            document.querySelector('body').classList.remove('dark')
            document.querySelector('nav').classList.remove('dark')
            document.querySelector('footer').classList.remove('dark')
            document.getElementById('accordionSidebar').classList.remove('dark')
            document.getElementById('content').classList.remove('dark')

            document.querySelector('nav').classList.add('bg-white')
            document.querySelector('footer').classList.add('bg-white')
            document.getElementById('accordionSidebar').classList.add('bg-gradient-primary')
        }
    }
    function copyValue(id) {
        var $input = $('#'+id);
        $input.val();
        console.log($input)
        if (navigator.userAgent.match(/ipad|ipod|iphone/i)) {
            $input.select();
            var el = $input.get(0);
            var editable = el.contentEditable;
            var readOnly = el.readOnly;
            el.contentEditable = true;
            el.readOnly = false;
            var range = document.createRange();
            range.selectNodeContents(el);
            var sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
            el.setSelectionRange(0, 999999);
            el.contentEditable = editable;
            el.readOnly = readOnly;
        } else {
            $input.select();
        }
        document.execCommand('copy');
        $input.blur();
        alertify.success("Copied the address");
    }
    /**
     * Module for displaying "Waiting for..." dialog using Bootstrap
     *
     * @author Eugene Maslovich <ehpc@em42.ru>
     */

    var waitingDialog = waitingDialog || (function ($) {
        'use strict';

        // Creating modal dialog's DOM
        var $dialog = $(
            '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
            '<div class="modal-dialog modal-m">' +
            '<div class="modal-content">' +
            '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
            '<div class="modal-body text-center">' +
            '<div class="spinner-border text-success" style="width: 100px; height: 100px;" role="status">'+
            '<span class="sr-only">Loading...</span></div>'+
            '</div>' +
            '</div></div></div>');

        return {
            /**
             * Opens our dialog
             * @param message Custom message
             * @param options Custom options:
             * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
             * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
             */
            show: function (message, options) {
                // Assigning defaults
                if (typeof options === 'undefined') {
                    options = {};
                }
                if (typeof message === 'undefined') {
                    message = 'Loading';
                }
                var settings = $.extend({
                    dialogSize: 'm',
                    progressType: '',
                    onHide: null // This callback runs after the dialog was hidden
                }, options);

                // Configuring dialog
                $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
                $dialog.find('.progress-bar').attr('class', 'progress-bar');
                if (settings.progressType) {
                    $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
                }
                $dialog.find('h3').text(message);
                // Adding callbacks
                if (typeof settings.onHide === 'function') {
                    $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
                        settings.onHide.call($dialog);
                    });
                }
                // Opening dialog
                $dialog.modal();
            },
            /**
             * Closes dialog
             */
            hide: function () {
                $dialog.modal('hide');
            }
        };

    })(jQuery);

</script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('js/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('js/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Page level plugins -->
<script src="{{ asset('/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
    function currencyFormat(num) {
        return '$' + num.toFixed(8).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            return uri + separator + key + "=" + value;
        }
    }
    var languageObject = {
        "decimal":        "@lang('datatable.decimal')",
        "emptyTable":     "@lang('datatable.emptyTable')",
        "info":           "@lang('datatable.info')",
        "infoEmpty":      "@lang('datatable.infoEmpty')",
        "infoFiltered":   "@lang('datatable.infoFiltered')",
        "infoPostFix":    "@lang('datatable.infoPostFix')",
        "thousands":      "@lang('datatable.thousands')",
        "lengthMenu":     "@lang('datatable.lengthMenu')",
        "loadingRecords": "@lang('datatable.loadingRecords')",
        "processing":     "@lang('datatable.processing')",
        "search":         "@lang('datatable.search')",
        "zeroRecords":    "@lang('datatable.zeroRecords')",
        "paginate": {
            "first":      "@lang('datatable.paginate.first')",
            "last":       "@lang('datatable.paginate.last')",
            "next":       "@lang('datatable.paginate.next')",
            "previous":   "@lang('datatable.paginate.previous')"
        },
        "aria": {
            "sortAscending":  "@lang('datatable.aria.sortAscending')",
            "sortDescending": "@lang('datatable.aria.sortDescending')"
        }
    }
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": languageObject
        });

        if (navigator.userAgent.match(/ipod|iphone/i)) {
            $('#accordionSidebar').addClass('toggled');
        }

        $(".lang-select").click(function(){
           var url = window.location.href;
           url = updateQueryStringParameter(url, 'lang', $(this).attr('data-lang'))
            window.location.href = url;
        })
    });
</script>