1.if link then always use getatable
2.if form submit then use postage
folder

return $this->hasOne('App\Phone', 'foreign_key', 'local_key');

{{ HTML::image('img/bus.jpg', 'a picture', array('id' => 'friends','style'=>'width:40px; height:40px;')) }}
<script>

$(document).ready(function() {
    animateCircle();
});

var phi = 0;

var int = 2 * (Math.PI) / 1000;

function animateCircle() {

    phi = (phi >= 2 * (Math.PI)) ? 0 : (phi + int);

    var $m = 400 - 200 * Math.cos(phi);

    var $n = 250 - 200 * Math.sin(phi);

    $("#friends").animate({
        marginLeft: $m + 'px',
        marginTop: $n + 'px'
    }, 1, animateCircle);

}
</script>