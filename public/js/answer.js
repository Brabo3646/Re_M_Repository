'use strict';

{$(document).ready(function(){
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
    });
    let question_number = 1;
    // 最初の問題を表示
    $('.question_' + question_number).removeClass('hidden_question');
    console.log("ok");
    // 答えを見るボタンを押すと、問題の解答画面が出る
    $('#check_answer_button').on('click', function(){
        $('#mask').removeClass('backHidden');
        $('#modal').removeClass('backHidden');
    });
    // 正解・不正解ボタンを押すと、解答画面がきえて、次の問題が出る
    $('.CE_button').on('click', function(e){
        e.preventDefault();
        let CE = $(this).val(); 
        let quiz_id = $('input[name="quiz_id"]').val();
        let user_id = $('input[name="user_id"]').val();
        $.ajax({
            url: "/quiz/answer/CE",
            method: "POST",
            data: { CE : CE, quiz_id : quiz_id, user_id : user_id },
            dataType: "json",})
            .done(function(res) {
                console.log(res.code);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
            });
        $('#mask').addClass('backHidden');
        $('#modal').addClass('backHidden');
        $('.question_' + question_number).addClass('hidden_question');
        question_number ++;
        $('.question_' + question_number).removeClass('hidden_question');
    });
})};