$(function() {
/*	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
        var categorys = this.el.find('.category');
		// Evento
        links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
		categorys.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();
		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple  && $this.attr('class') != 'category') {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		}else{
            $el.find('.link').not($next).slideUp().parent().removeClass('open');
        }
	}*/

	//var accordion = new Accordion($('#accordion'), false);
   $('#accordion').metisMenu({
                    doubleTapToGo: true
                }); //

    $('.submenu .api-return .clear').on('click', function () {
        $(this).parent().find('.result').html('');
    });

    if(localStorage.getItem('token')){
        $('#headers').html(localStorage.getItem('token'));
    }

    $('.btn-test').on('click', function () {
        var $this = $(this),
            headers = $('textarea#headers').val(),
            options = {dataType: 'json', data: {}};
        $this.parent().parent().find('.params input').each(function (index, obj) {
            if ($(obj).val().length > 0) {
                options.data[$(obj).attr('name')] = $(obj).val();
            }
        });
        if (headers) {
            options.headers = {};
            $.each(headers.split("\n"), function (index, item) {
                var header = item.split(':');
                options.headers[header[0]] = encodeURI(header[1]) || '';
            });
        }
        options.url = $this.data('url').trim();
        options.method = $this.data('method').trim().toUpperCase();
        options.complete = function (XHR, status) {
            $this.parent().parent().find('.api-return').show();
            var options = {
              collapsed: true,
            };
            var str =eval('(' + XHR.responseText + ')');
            if(str.hasOwnProperty('data') && str.data.hasOwnProperty('token')){
                $('#headers').html('token:bearer'+str.data.token);
                localStorage.setItem('token','token:bearer'+str.data.token);
            }
            $this.parent().parent().find('.api-return .result').jsonViewer(str,options);
            $('.result>a.json-toggle').click();
            //$this.parent().parent().find('.api-return .result').html(status == 'success' ?formatJson(XHR.responseText) : '接口出错,赶紧联系后端大佬!');
        };
        $.ajax(options);
    });
});
