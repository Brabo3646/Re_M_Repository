'use strict';

function check(){
    if(window.confirm
    ('デッキ自体を削除すると、共有されているほかのクルーたちも使用することができなくなります。それでもよろしければOKを押してください。')){
        return true;
    } else {
        return false;
    }
}