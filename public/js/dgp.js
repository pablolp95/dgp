/**
 * Created by pablo on 12/11/16.
 */
$(document).ready(function() {
    $('select').material_select();
    $('.modal').modal();
});

$("#addTrigger").click(function(){
    addTab();
});

$("#deleteTrigger").click(function(){
    deleteTab();
});

function addTab(){
    var selectValue = $( "#language_id" ).val();
    // If tab doesn't  exist in the list
    if($("#" + selectValue).length == 0) {
        $("#languages").show();
        //add new tab
        var selectText = $( "#language_id option:selected" ).text();
        var tabs = $('#tabs');
        var deleteButtonDiv = $("#deleteLanguage");
        tabs.children().removeAttr('style');

        tabs.append("<li class='tab'><a href='#" + selectValue + "'>" + selectText + "</a></li>");
        deleteButtonDiv.before(
            "<div id='" + selectValue + "'>" +
                "<div class='input-field'>" +
                    "<input id='title' class='validate' name='texts[" + selectValue + "][title]' type='text'>" +
                    "<label for='title'>Título del stand:*</label>" +
                "</div>" +
                "<!-- Description field -->" +
                "<div class='input-field'>" +
                    "<textarea id='description' class='materialize-textarea' name='texts[" + selectValue + "][description]' cols='50' rows='10'></textarea>" +
                    "<label for='description'>Descripción del stand:*</label>" +
                "</div>" +
                "<div class='col s12 no-padding'>"+
                    "<h6 style='color:#9E9E9E'>Vídeos asociados</h6>"+
                    "<ul id='video-list-" + selectValue + "' class='list collection with-header'>"+
                        "<li id='video-label' class='collection-item'><label>Asociar un nuevo video...</label></li>"+
                    "</ul>"+
                "</div>" +
                "<button type='button' id='show-videos' class='waves-effect waves-light btn indigo left'>Mostrar vídeos</button>"+
                "<div class='col s12 no-padding'>"+
                    "<h6 style='color:#9E9E9E'>Audios asociados</h6>"+
                    "<ul id='audio-list-" + selectValue + "' class='list collection with-header'>"+
                        "<li id='audio-label' class='collection-item'><label>Asociar un nuevo audio...</label></li>"+
                    "</ul>"+
                "</div>" +
                "<button type='button' id='show-audio' class='waves-effect waves-light btn indigo left'>Mostrar audios</button>"+
            "</div>"
        );
        // initalize tabs again, then select new tab
        tabs.tabs().tabs('select_tab', selectValue);
    }
}

function deleteTab(){
    //Obtain actual selected tab id
    var a_href = $( "ul.tabs li.tab a.active" ).attr( 'href' );
    var itemId = a_href.substring(1, a_href.length);
    var tabs = $('#tabs');

    //Remove tab
    $("ul.tabs li.tab a.active" ).parent().remove();
    //Remove content associate with the tab
    $("#"+itemId+"" ).remove();
    if($("ul.tabs li").length != 0){
        var lastHref = $('ul.tabs li.tab').last().children().attr('href');
        var lastId = lastHref.substring(1, lastHref.length);
        tabs.tabs().tabs('select_tab', lastId);
    }
    else{
        $("#languages").hide();
    }
}

$(document).on("click", "#show-videos", function() {
    var getdetails = function( id ) {
        var base_url = location.hostname;
        return $.getJSON("http://"+base_url+"/api/video/available", {

            "language": id

        });

    };

    var a_href = $( "ul.tabs li.tab a.active" ).attr( 'href' );
    var itemId = a_href.substring( 1, a_href.length );

    getdetails( itemId )
        .done(function(response) {
            var output ='';
            $.each(response, function(index,value) {
                if($("#video-" + value.id).length == 0){
                    output += '<li class="collection-item">' +
                    '<input type="checkbox" class="filled-in" id="id-'+ value.id +'" value="'+ value.id + '"/>' +
                    '<label for="id-'+ value.id +'">' + value.name + '</label>' +
                    '</li>';
                }
            });
            $("#video-response-container").html(output);
        })

        .fail(function(jqXHR, textStatus, errorThrown) {

            $("#video-response-container").html("Algo ha fallado: " + textStatus + errorThrown);

        });

    if($('#response-container li').length == 0){
        $('#response-container').html('<li class="collection-item">No hay recursos disponibles</li>');
    }
    $('#video-response-modal').modal('open');
});

$(document).on("click", "#show-audio", function() {
    var getdetails = function( id ) {
        var base_url = location.hostname;
        return $.getJSON("http://"+base_url+"/api/audio/available", {

            "language": id

        });

    };

    var a_href = $( "ul.tabs li.tab a.active" ).attr( 'href' );
    var itemId = a_href.substring( 1, a_href.length );

    getdetails( itemId )
        .done(function(response) {
            var output ='';
            $.each(response, function(index,value) {
                if($("#audio-" + value.id).length == 0){
                    output += '<li class="collection-item">' +
                        '<input type="checkbox" class="filled-in" id="id-'+ value.id +'" value="'+ value.id + '"/>' +
                        '<label for="id-'+ value.id +'">' + value.name + '</label>' +
                        '</li>';
                }
            });
            $("#audio-response-container").html(output);
        })

        .fail(function(jqXHR, textStatus, errorThrown) {

            $("#audio-response-container").html("Algo ha fallado: " + textStatus + errorThrown);

        });

    /*if($('#response-container li').length == 0){
     $('#response-container').html('<li class="collection-item">No hay recursos disponibles</li>');
     }*/
    $('#audio-response-modal').modal('open');
});

$(document).on("click", "#show-images", function() {
    var getdetails = function() {
        var base_url = location.hostname;
        return $.getJSON("http://"+base_url+"/api/image/available");

    };

    getdetails()
        .done(function(response) {
            var output ='';
            $.each(response, function(index,value) {
                if($("#image-" + value.id).length == 0){
                    output += '<li class="collection-item">' +
                        '<input type="checkbox" class="filled-in" id="id-'+ value.id +'" value="'+ value.id + '"/>' +
                        '<label for="id-'+ value.id +'">' + value.name + '</label>' +
                        '</li>';
                }
            });
            $("#image-response-container").html(output);
        })

        .fail(function(jqXHR, textStatus, errorThrown) {

            $("#image-response-container").html("Algo ha fallado: " + textStatus + errorThrown);

        });

    /*if($('#response-container li').length == 0){
     $('#response-container').html('<li class="collection-item">No hay recursos disponibles</li>');
     }*/
    $('#image-response-modal').modal('open');
});

$(document).on("click", "#show-stands-zones", function() {
    var getdetails = function(resource) {
        var base_url = location.hostname;
        return $.getJSON("http://"+base_url+"/api/stand/available?resource=zone");

    };

    getdetails()
        .done(function(response) {
            var output ='';
            $.each(response, function(index,value) {
                if($("#stand-" + value.id).length == 0){
                    output += '<li class="collection-item">' +
                        '<input type="checkbox" class="filled-in" id="id-'+ value.id +'" value="'+ value.id + '"/>' +
                        '<label for="id-'+ value.id +'">' + value.name + '</label>' +
                        '</li>';
                }
            });
            $("#stand-response-container").html(output);
        })

        .fail(function(jqXHR, textStatus, errorThrown) {

            $("#stand-response-container").html("Algo ha fallado: " + textStatus + errorThrown);

        });

    /*if($('#response-container li').length == 0){
     $('#response-container').html('<li class="collection-item">No hay recursos disponibles</li>');
     }*/
    $('#stand-response-modal').modal('open');
});

$(document).on("click", "#show-stands-routes", function() {
    var getdetails = function(resource) {
        var base_url = location.hostname;
        return $.getJSON("http://"+base_url+"/api/stand/available?resource=route");

    };

    getdetails()
        .done(function(response) {
            var output ='';
            $.each(response, function(index,value) {
                if($("#stand-" + value.id).length == 0){
                    output += '<li class="collection-item">' +
                        '<input type="checkbox" class="filled-in" id="id-'+ value.id +'" value="'+ value.id + '"/>' +
                        '<label for="id-'+ value.id +'">' + value.name + '</label>' +
                        '</li>';
                }
            });
            $("#stand-response-container").html(output);
        })

        .fail(function(jqXHR, textStatus, errorThrown) {

            $("#stand-response-container").html("Algo ha fallado: " + textStatus + errorThrown);

        });

    /*if($('#response-container li').length == 0){
     $('#response-container').html('<li class="collection-item">No hay recursos disponibles</li>');
     }*/
    $('#stand-response-modal').modal('open');
});

$(document).on("click", "#video-modal-confirm", function() {
    var a_href = $( "ul.tabs li.tab a.active" ).attr( 'href' );
    var itemId = a_href.substring( 1, a_href.length );
    var id;

    $('#video-label').remove();
    $('#video-response-container').children('li').each(function() {
        if($(this).children('input[type=checkbox]').is(':checked')){
            id = $(this).children('input').val();
            $('#video-list-' + itemId).append('<li class="collection-item">' +
                '<input id="video-' + id + '" type="hidden" name="videos[]" value="' + id + '">' +
                $(this).children('label').html() +
                '<a href="#!" class="delete-video-resource secondary-content"><i class="material-icons">delete</i></a>' +
                '</li>');
        }
    });

    if($('#video-list-' + itemId + ' li').length == 0){
        $('#video-list-' + itemId).append("<li id='video-label' class='collection-item'><label>Asociar un nuevo vídeo...</label></li>");
    }

    $('#video-response-container').empty();
    $('#video-response-modal').modal('close');
});

$(document).on("click", "#audio-modal-confirm", function() {
    var a_href = $( "ul.tabs li.tab a.active" ).attr( 'href' );
    var itemId = a_href.substring( 1, a_href.length );
    var id;

    $('#audio-label').remove();
    $('#audio-response-container').children('li').each(function() {
        if($(this).children('input[type=checkbox]').is(':checked')){
            id = $(this).children('input').val();
            $('#audio-list-' + itemId).append('<li class="collection-item">' +
                '<input id="audio-' + id + '" type="hidden" name="audio[]" value="' + id + '">' +
                $(this).children('label').html() +
                '<a href="#!" class="delete-audio-resource secondary-content"><i class="material-icons">delete</i></a>' +
                '</li>');
        }
    });

    if($('#audio-list-' + itemId + ' li').length == 0){
        $('#audio-list-' + itemId).append("<li class='collection-item'><label>Asociar un nuevo audio...</label></li>");
    }

    $('#audio-response-container').empty();
    $('#audio-response-modal').modal('close');
});

$(document).on("click", "#image-modal-confirm", function() {
    var id;

    $('#image-label').remove();
    $('#image-response-container').children('li').each(function() {
        if($(this).children('input[type=checkbox]').is(':checked')){
            id = $(this).children('input').val();
            $('#image-list').append('<li class="collection-item">' +
                '<input id="image-' + id + '" type="hidden" name="images[]" value="' + id + '">' +
                $(this).children('label').html() +
                '<a href="#!" class="delete-image-resource secondary-content"><i class="material-icons">delete</i></a>' +
                '</li>');
        }
    });

    if($('#image-list li').length == 0){
        $('#image-list').append("<li id='image-label' class='collection-item'><label>Asociar una nueva imágenes...</label></li>");
    }

    $('#image-response-container').empty();
    $('#image-response-modal').modal('close');
});

$(document).on("click", "#stand-modal-confirm", function() {
    var id;

    $('#stand-label').remove();
    $('#stand-response-container').children('li').each(function() {
        if($(this).children('input[type=checkbox]').is(':checked')){
            id = $(this).children('input').val();
            $('#stand-list').append('<li class="collection-item">' +
                '<input id="stand-' + id + '" type="hidden" name="stands[]" value="' + id + '">' +
                $(this).children('label').html() +
                '<a href="#!" class="delete-image-resource secondary-content"><i class="material-icons">delete</i></a>' +
                '</li>');
        }
    });

    if($('#stand-list li').length == 0){
        $('#stand-list').append("<li id='stand-label' class='collection-item'><label>Asociar un nuevo stand...</label></li>");
    }

    $('#stand-response-container').empty();
    $('#stand-response-modal').modal('close');
});

$(document).on("click", ".delete-video-resource", function() {
    var list = '#' + $(this).parent().parent().attr('id');
    $(this).parent().remove();

    if($(list + ' li').length == 0){
        $(list).append("<li id='video-label' class='collection-item'><label>Asociar un nuevo video...</label></li>");
    }
});

$(document).on("click", ".delete-audio-resource", function() {
    var list = '#' + $(this).parent().parent().attr('id');
    $(this).parent().remove();

    if($(list + ' li').length == 0){
        $(list).append("<li id='audio-label' class='collection-item'><label>Asociar un nuevo audio...</label></li>");
    }
});

$(document).on("click", ".delete-image-resource", function() {
    var list = '#' + $(this).parent().parent().attr('id');
    $(this).parent().remove();

    if($(list + ' li').length == 0){
        $(list).append("<li id='image-label' class='collection-item'><label>Asociar una nueva imagen...</label></li>");
    }
});

function initStandValidation() {
    $("form").materialid({
        fields: {
            name: {
                validators: {
                    notEmpty: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initRouteValidation() {
    $("form").materialid({
        fields: {
            name: {
                validators: {
                    notEmpty: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initZoneValidation() {
    $("form").materialid({
        fields: {
            name: {
                validators: {
                    notEmpty: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initAudioValidation() {
    $("form").materialid({
        fields: {
            name: {
                validators: {
                    notEmpty: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initImageValidation() {
    $("form").materialid({
        fields: {
            name: {
                validators: {
                    notEmpty: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initVideoValidation() {
    $("form").materialid({
        fields: {
            name: {
                validators: {
                    notEmpty: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initUserValidation() {
    $("form").materialid({
        fields: {
            email: {
                validators: {
                    notEmpty: {},
                    email: {}
                }
            },
            password: {
                validators: {
                    notEmpty: {}
                }
            },
            name: {
                validators: {
                    notEmpty: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

//# sourceMappingURL=maps/ddsi.min.js.map