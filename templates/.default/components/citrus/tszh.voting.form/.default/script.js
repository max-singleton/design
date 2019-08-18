/**** активаци€ кнопки "√олосовать" когда выбраны ответы на все вопросы голосовани€****/
$(document).ready(function() {
    var inputVote = $('.vote .radio-switcher input,.vote .input-checkbox input');
    var submitVote = $('.vote__submit');
    if (inputVote.length && submitVote.length) {
        inputVote.change(function () {
            var inputName = '', countName = 0, checked = {};
            for (var i = 0; i < inputVote.length; i++) {
                if (inputName != inputVote[i].name) {
                    countName++;
                    inputName = inputVote[i].name;
                }

                if (inputVote[i].checked && checked[inputVote[i].name] === undefined){
                    checked[inputVote[i].name] = true;
                }
            }
            submitVote[0].disabled = countName != Object.keys(checked).length;
        });
    }
});