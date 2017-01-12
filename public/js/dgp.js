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
                        "<li class='collection-item'><label>Asociar un nuevo vídeo...</label></li>"+
                    "</ul>"+
                "</div>" +
                "<button type='button' id='show-videos' class='waves-effect waves-light btn indigo left'>Mostrar vídeos</button>"+
                "<div class='col s12 no-padding'>"+
                    "<h6 style='color:#9E9E9E'>Audios asociados</h6>"+
                    "<ul id='audio-list-" + selectValue + "' class='list collection with-header'>"+
                        "<li class='collection-item'><label>Asociar un nuevo audio...</label></li>"+
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
             output+='<li class="collection-item">' +
             '<input type="checkbox" class="filled-in" id="id-'+ value.id +'" value="'+ value.id +'"/>' +
             '<label for="id-'+ value.id +'">' + value.name + '</label>' +
             '</li>';

            });
            $("#response-container").html(output);
        })

        .fail(function(jqXHR, textStatus, errorThrown) {

            $("#response-container").html("Algo ha fallado: " + textStatus + errorThrown);

        });

    $('#response-modal').modal('open');
});

$(document).on("click", "#modal-confirm", function() {
    var a_href = $( "ul.tabs li.tab a.active" ).attr( 'href' );
    var itemId = a_href.substring( 1, a_href.length );
    var list = 'video-list-' + itemId;
    $('#video-list-' + itemId).empty();
    $('#response-container').children('li').each(function() {
        if($(this).children('input[type=checkbox]').is(':checked')){
            $('#video-list-' + itemId).append('<li class="collection-item">' +
                '<input type="hidden" name="videos[]" value="' + $(this).children('input').val()  + '">' +
                $(this).children('label').html() + '</li>');
            //alert($(this).children('label').html());
        }
        //alert($(this).children('input[type=checkbox]').val());
    });
    /*$.each($('input[type=checkbox]:checked'), function() {
        alert($(this).val());
    });*/

    $('#response-container').empty();
    $('#response-modal').modal('close');
});

$(document).on("click", "#modal-cancel", function() {
    $('#response-modal').modal('close');
});

$(document).on("click", "#show-audio", function() {
    $('#response-modal').modal('open');
});

$(document).on("click", "#show-images", function() {
    $('#response-modal').modal('open');
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
            },
            description: {
                validators: {
                    notEmpty: {}
                }
            },
            floor: {
                validators: {
                    notEmpty: {},
                    numeric:{}
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
            },
            description: {
                validators: {
                    notEmpty: {}
                }
            },
            floor: {
                validators: {
                    notEmpty: {},
                    numeric:{}
                }
            },
            thematic: {
                validators:{
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
            },
            description: {
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
            },
            description: {
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
            },
            description: {
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