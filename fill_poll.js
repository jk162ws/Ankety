$(document).ready(function() {
    
    $("input[value^='question'][type^='checkbox']").change(function() {
        var id = parseInt($(this).attr('value').replace(/[a-z]+([0-9]+)[a-zA-Z0-9]+/, "$1"));
        var text = $(this).attr("value").replace(/[a-z]+([0-9]+)([a-zA-Z0-9]+)/, "$2");
        var checked = $(this).prop('checked')
        if(checked) {
            $.post("fill_poll.php", {signal: "checkboxAdded", index: id, text: text});
        }
        else {
            $.post("fill_poll.php", {signal: "checkboxRemoved", index: id, text: text});
        }
        
    });
    $("input[value^='question'][type^='radio']").change(function() {
        var id = parseInt($(this).attr('value').replace(/[a-z]+([0-9]+)[a-zA-Z0-9]+/, "$1"));
        var text = $(this).attr("value").replace(/[a-z]+([0-9]+)([a-zA-Z0-9]+)/, "$2");
        $.post("fill_poll.php", {signal: "radioChanged", index: id, text: text});
    });
    
    $("input[name^='question'][type^='text']").change(function() {
        var id = parseInt($(this).attr('name').replace(/[a-z_]+([0-9]+)/, "$1"));
        var text = $(this).val();
        $.post("fill_poll.php", {signal: "textfieldChanged", index: id, text: text});
    });
});


