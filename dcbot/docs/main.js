function load(){

    var viewport_width = document.documentElement.clientHeight;
    var a = document.getElementById("header").offsetHeight;
    var vyska = viewport_width - a;
    document.getElementById("nav").style.height= `${vyska}px`;
    document.getElementById("context").style.height= `${vyska}px`;
}
window.addEventListener('resize', function(event){
    var viewport_width = document.documentElement.clientHeight;
    var a = document.getElementById("header").offsetHeight;
    var vyska = viewport_width - a;
    document.getElementById("nav").style.height= `${vyska}px`;
    document.getElementById("context").style.height= `${vyska}px`;
});

function gomain(){
    return window.location.href = '/';
}

$(".nav-title").click(function (){
    var dataValue = $(this).attr('data-value');
    dataValue = $('#' + dataValue);
    $(dataValue).toggle('slow');

    var data = $(this).attr('data-value');
    data = $('#' + data + '-arrow');

    if($(data).css('transform') == 'matrix(6.12323e-17, -1, 1, 6.12323e-17, 0, 0)'){
        $(data).animate(
            {deg: 0},
            {
                duration: 700,
                step: function(now){
                    $(this).css({ transform: 'rotate(' + now + 'deg)' });
                }
            }
        )
    
    }else{
        console.log($(data).css('transform'));
        $(data).animate(
            {deg: -90},
            {
                duration: 700,
                step: function(now){
                    $(this).css({ transform: 'rotate(' + now + 'deg)' });
                }
            }
        )
    
    }
});

