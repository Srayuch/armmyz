<script type="text/javascript">
    //---------------------------------- [ START : SCRIPT ] ----------------------------------//

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    function sweet(type, string) {
        Toast.fire({
        icon: type,
        title: string
        })
    }

    $('.counter').each(function() {
        var $this = $(this),
        countTo = $this.attr('data-count');
        $({
        countNum: $this.text()
        }).animate({
            countNum: countTo
        },
        {
            duration: 1000,
            easing: 'linear',
            step: function() {
            $this.text(commaSeparateNumber(Math.floor(this.countNum)));
            },
            complete: function() {
            $this.text(commaSeparateNumber(this.countNum));
            //alert('finished');
            }
        }
        );
    });
    
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
        val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }

    //---------------------------------- [ END : SCRIPT ] ----------------------------------//
</script>