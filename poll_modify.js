$(document).ready(function() {
    
    $("input[name^='poll_name']").change(function() {
        var text = $(this).val();
        $.post("poll_modify.php", {signal: "pollnameChange", text: text});
    });
    $("input[name^='poll_type']").change(function() {
        var text = $(this).val();
        $.post("poll_modify.php", {signal: "polltypeChange", text: text});
    });
    $("input[name^='poll_password']").change(function() {
        var text = $(this).val();
        $.post("poll_modify.php", {signal: "pollpasswordChange", text: text});
    });
    $("#add").click(function() {
        var index = getNewQuestionId();
        $("#poll_questions").append('<div id="question' + index +'"><b>Otázka: </b> <input type="text" name="question_text' + index + '"><br>' +
                    '<b>Typ odpovedi: </b><br>' +
                    '<input type="radio" name="question_type' + index + '" value="checkbox">Zašktrnutie viacerých možností<br>' +
                    '<input type="radio" name="question_type' + index + '" value="checkbox_textfield">Zašktrnutie viacerých možností s vlastnou odpoveďou<br>' +
                    '<input type="radio" name="question_type' + index + '" value="radio">Zašktrnutie jednej možnosti<br>' +
                    '<input type="radio" name="question_type' + index + '" value="radio_textfield">Zašktrnutie jednej možnosti s vlastnou odpoveďou<br>'+
                    '<input type="radio" name="question_type' + index + '" value="textfield">Vlastná odpoveď<br>');
        $("#poll_questions").append('<div id="answers' + index + '"></div>');
        $("#poll_questions").append('<input id="addanswer' + index + '" type="button" value="Pridať možnosť"><br>' +
            '<input id="remove' + index + '" type="button" value="Odstráň otázku"></div>');
        $.post("poll_modify.php", {signal: "add"});
    });
    $(document).on("change", "input[name^='question_text']", function() {
        var id = parseInt($(this).attr('name').replace(/[^\d]/g, ''), 10);
        var text = $(this).val();
        $.post("poll_modify.php", {signal: "textChange", index: id, text: text});
    });
    $(document).on("change", "input[name^='question_type']", function() {
        var id = parseInt($(this).attr('name').replace(/[^\d]/g, ''), 10);
        var type = $(this).val();
        $.post("poll_modify.php", {signal: "typeChange", index: id, text: type});
    });
    $(document).on("click", "input[id^='remove']", function() {
        if($(this).attr('id').indexOf("answer") < 0) {
            var id = parseInt($(this).attr('id').replace(/[^\d]/g, ''), 10);
            $("#question"+id).remove();
            $(this).remove();
            $.post("poll_modify.php", {signal: "delete", index: id});
        }
    });
    $(document).on("click", "input[id^='addanswer']", function() {
        var id = parseInt($(this).attr('id').replace(/[^\d]/g, ''), 10);
        var j = getNewAnserId(id);
        $("#answers"+id).append('<div id="question' + id + 'answer' + j +'"><b>Možnosť: </b><input type="text" name="question' + id + 'answer_text' + j +'"><input id="remove' + id + 'answer' + j +'" type="button" value="Odstráň možnosť"></div>');
        $.post("poll_modify.php", {signal: "addAnswer", index: id});
    });
    $(document).on("click","input[id^='remove'][id*='answer']", function() {
        var id = parseInt($(this).attr('id').replace(/[a-z]+([0-9]+)[a-z]+([0-9]+)/, "$1"));
        var answerId = parseInt($(this).attr('id').replace(/[a-z]+([0-9]+)[a-z]+([0-9]+)/, "$2"));
        $("#question"+id+"answer"+answerId).remove();
        $.post("poll_modify.php", {signal: "deleteAnswer", index: id, answerIndex: answerId});
    });
    $(document).on("change", "input[name^='question'][name*='answer_text']", function() {
        var id = parseInt($(this).attr('name').replace(/[a-z]+([0-9]+)[a-z_]+([0-9]+)/, "$1"));
        var answerId = parseInt($(this).attr('name').replace(/[a-z]+([0-9]+)[a-z_]+([0-9]+)/, "$2"));
        var text = $(this).val();
        $.post("poll_modify.php", {signal: "answerTextChange", index: id, answerIndex: answerId, text: text});
    });
    
    function getNewAnserId(questionId) {
        for(j = 0; j < 100; j++) {
            if(document.getElementById("question" + questionId + "answer" + j) === null)
                return j;
        }
    }
    
    function getNewQuestionId() {
        for(j = 0; j < 100; j++) {
            if(document.getElementById("question" + j) === null)
                return j;
        }
    }
});


