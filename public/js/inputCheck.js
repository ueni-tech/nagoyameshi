document.addEventListener('DOMContentLoaded', function () {
  const userInputs = document.querySelectorAll('.userInput');

  function updateButtonState() {
    userInputs.forEach(function (userInput) {
      // 全てのuserInputが空でなければボタンを有効にする
      if (userInput.value === '') {
        document.getElementById('submit_button').disabled = true;
      } else {
        document.getElementById('submit_button').disabled = false;
      }

    });
  }

  // 全てのuserInputに対して、changeイベントを設定
  userInputs.forEach(function (userInput) {
    userInput.addEventListener('change', function () {
      updateButtonState();
    });
  });

  updateButtonState();
});