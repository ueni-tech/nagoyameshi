document.addEventListener('DOMContentLoaded', function () {
  const submitButton = document.getElementById('submit_button');
  const textInputs = document.querySelectorAll('input[type=text], input[type=file], textarea, input[type=time], input[type=date], input[type=number]');
  const checkboxes = document.querySelectorAll('input[type=checkbox]');

  function checkFormInputs() {
    // テキスト入力、ファイル入力、テキストエリアを選択
    // スペースのみの入力は無効とする
    let textFilled = true;
    textInputs.forEach(input => {
      if (input.value.trim() === '') {
        textFilled = false;
      }
    });

    // チェックボックスを名前ごとにグループ化
    const checkboxGroups = {};
    checkboxes.forEach(checkbox => {
      if (!checkboxGroups[checkbox.name]) {
        checkboxGroups[checkbox.name] = [];
      }
      checkboxGroups[checkbox.name].push(checkbox);
    });

    // 各グループのチェックボックスが少なくとも1つチェックされているか確認
    let checkboxChecked = Object.values(checkboxGroups).every(group => group.some(checkbox => checkbox.checked));

    // 全ての条件が満たされた場合、ボタンを有効にする
    submitButton.disabled = !(textFilled && checkboxChecked);
  }

  // フォームの全ての入力要素にイベントリスナーを設定
  checkboxes.forEach(checkbox => checkbox.addEventListener('change', checkFormInputs));
  textInputs.forEach(input => input.addEventListener('input', checkFormInputs));

  // 初期状態のチェック
  checkFormInputs();
});