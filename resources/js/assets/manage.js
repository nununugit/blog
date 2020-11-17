$(function() {
    $("#button1").click(function() {
        var url = $('#baseurl').val();
        var method = "GET";
        // $.ajaxSetup({
        //     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        // })
        $.ajax({
                url: url,
                type: method,
                timeout: 5000,
                beforeSend: function(jqXHR, settings) {
                    $("#method").text(method);
                    $("#url").text(url);
                    $("#data").text(settings.data);
                },
            })
            .done(function(data, textStatus, jqXHR) {
                $("#status").text(jqXHR.status);
                $("#json").text(JSON.stringify(data));
                $("#message").text("");
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $("#status").text("err:" + jqXHR.status);
                $("#json").text(textStatus);
                $("#message").text(errorThrown);
            })
            .always(function() {});
    });

    $("#button2").click(function() {
        var url = $('#baseurl').val();
        var method = "POST";
        var json = {
            "title": $('#title2').val(),
            "content": $('#content2').val(),
        };
        $.ajax({
                url: url,
                type: method,
                timeout: 5000,
                contentType: "application/json",
                data: JSON.stringify(json),
                dataType: "json",
                beforeSend: function(jqXHR, settings) {
                    $("#method").text(method);
                    $("#url").text(url);
                    $("#data").text(settings.data);
                },
            })
            .done(function(data, textStatus, jqXHR) {
                $("#status").text(jqXHR.status);
                $("#json").text(JSON.stringify(data));
                $("#message").text("");
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $("#status").text("err:" + jqXHR.status);
                $("#json").text(textStatus);
                $("#message").text(errorThrown);
            })
            .always(function() {});
    });

    $("#button3").click(function() {
        var url = $('#baseurl').val() + "/" + $('#id3').val();
        var method = "GET";
        // $.ajaxSetup({
        //     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        // })
        $.ajax({
                url: url,
                type: method,
                timeout: 5000,
                beforeSend: function(jqXHR, settings) {
                    $("#method").text(method);
                    $("#url").text(url);
                    $("#data").text(settings.data);
                },
            })
            .done(function(data, textStatus, jqXHR) {
                $("#status").text(jqXHR.status);
                $("#json").text(JSON.stringify(data));
                $("#message").text("");
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $("#status").text("err:" + jqXHR.status);
                $("#json").text(textStatus);
                $("#message").text(errorThrown);
            })
            .always(function() {});
    });

    $("#button4").click(function() {
        var url = $('#baseurl').val() + "/" + $('#id4').val();
        var method = "PUT";
        var json = {
            "title": $('#title4').val(),
            "content": $('#content4').val(),
        };
        // $.ajaxSetup({
        //     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        // })
        $.ajax({
                url: url,
                type: method,
                timeout: 5000,
                contentType: "application/json",
                data: JSON.stringify(json),
                dataType: "json",
                beforeSend: function(jqXHR, settings) {
                    $("#method").text(method);
                    $("#url").text(url);
                    $("#data").text(settings.data);
                },
            })
            .done(function(data, textStatus, jqXHR) {
                $("#status").text(jqXHR.status);
                $("#json").text(JSON.stringify(data));
                $("#message").text("");
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $("#status").text("err:" + jqXHR.status);
                $("#json").text(textStatus);
                $("#message").text(errorThrown);
            })
            .always(function() {});
    });

    $("#button5").click(function() {
        var url = $('#baseurl').val() + "/" + $('#id5').val();
        var method = "DELETE";
        // $.ajaxSetup({
        //     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        // })
        $.ajax({
                url: url,
                type: method,
                timeout: 5000,
                beforeSend: function(jqXHR, settings) {
                    $("#method").text(method);
                    $("#url").text(url);
                    $("#data").text(settings.data);
                },
            })
            .done(function(data, textStatus, jqXHR) {
                $("#status").text(jqXHR.status);
                $("#json").text(JSON.stringify(data));
                $("#message").text("");
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $("#status").text("err:" + jqXHR.status);
                $("#json").text(textStatus);
                $("#message").text(errorThrown);
            })
            .always(function() {});
    });
});