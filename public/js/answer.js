'use strict';

{$(document).ready(function(){
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
    });
    const quiz_count = parseInt($('#quiz_count').text(), 10);
    let correct_count = 0;
    let quiz_id = 0;
    console.log(quiz_count);
    let question_number = 1;
    // 最初の問題を表示
    $('.question_' + question_number).removeClass('hidden_question');
    // 答えを見るボタンを押すと、問題の解答画面が出る
    $('#check_answer_button').on('click', function(){
        $('#mask').removeClass('backHidden');
        $('#modal').removeClass('backHidden');
    });
    // 正解・不正解ボタンを押すと、解答画面がきえて、次の問題が出る
    $('.CE_button').on('click', function(e){
        e.preventDefault();
        let CE = $(this).val(); 
        quiz_id = $(this).closest('form').find('input[name="quiz_id"]').val();
        let user_id = $('input[name="user_id"]').val();
        console.log(quiz_id);
        let request = $.ajax({
            url: "/quiz/answer/CE",
            method: "POST",
            data: { CE : CE, quiz_id : quiz_id, user_id : user_id },
            dataType: "json",})
            .done(function(res) {
                console.log(res.code);
                if(res.code === "correct"){
                    correct_count ++;
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
            }); 
            // モーダルを再度隠す
        $('#mask').addClass('backHidden');
        $('#modal').addClass('backHidden');
        $('.question_' + question_number).addClass('hidden_question');
        question_number ++;
        if (question_number > quiz_count){
            $.when(request).done(function(){
                $('#front').append('<p>お疲れ様！' + quiz_count + '問中、' + correct_count + '問正解！</p>')
                $('#check_answer_button').addClass('hidden');
            }).fail(function(){
                $('#front').append('<p>予期しないエラーが発生しました！お手数ですが、製作者にご連絡ください。<p>')
            });
        } else {
        $('.question_' + question_number).removeClass('hidden_question');
        }
    });
})}