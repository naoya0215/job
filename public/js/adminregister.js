document.addEventListener('DOMContentLoaded', function() {
    //要素の取得
    const adminInfo = document.getElementById('adminInfo');
    const companyInfo = document.getElementById('companyInfo');
    const nextButton = document.getElementById('nextButton');
    const prevButton = document.getElementById('prevButton');
    const form = document.getElementById('registerForm');

    //要素取得できていない場合
    //以下エラーメッセージを出力
    if (!adminInfo || !companyInfo || !nextButton || !prevButton || !form) {
        console.error('One or more required elements are missing');
        return;
    }

    //アイテムイベント
    //次へボタンをクリックした時のイベント
    //新規登録フォームを非表示にし
    //企業情報フォームを表示する
    nextButton.addEventListener('click', function() {
        if (validateAdminForm()) {
            adminInfo.style.display = 'none';
            companyInfo.style.display = 'block';
        }
    });

    //アイテムイベント
    //戻るボタンをクリックした時のイベント
    //新規登録フォームを表示にし
    //企業情報フォームを非表示する
    prevButton.addEventListener('click', function() {
        adminInfo.style.display = 'block';
        companyInfo.style.display = 'none';
    });

    //アイテムイベント
    //formが送信された時に発火するイベント
    //デフォルトの送信を防止　※ページがリロードされたり、別のページに移動したりするのを防ぐ
    //管理者情報と企業情報の両方が有効である場合にのみフォームが送信。
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (validateAdminForm() && validateCompanyForm()) {
            submitForm();
        }
    });
});

//バリデーションメッセージ(新規登録)を表示する
function validateAdminForm() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;

    if (!name || !email || !password || !passwordConfirmation) {
        alert('すべての必須フィールドを入力してください。');
        return false;
    }

    if (password !== passwordConfirmation) {
        alert('パスワードが一致しません。');
        return false;
    }

    return true;
}


//バリデーションメッセージ(企業情報)を表示する
function validateCompanyForm() {
    const prefectureName = document.getElementById('prefecture').value.trim();
    const description = document.getElementById('description').value.trim();
    const location = document.getElementById('location').value.trim();
    const website = document.getElementById('website').value.trim();

    if (!prefectureName || !description || !location) {
        alert('すべての必須フィールドを入力してください。');
        return false;
    }

    //websiteに入力されている　かつ　URLでない場合
    //以下エラーメッセージを出力
    if (website && !isValidUrl(website)) {
        alert('有効なURLを入力してください。');
        return false;
    }

    return true;
}

function isValidUrl(string) {
    try {
        new URL(string);
        return true;
    } catch (_) {
        return false;
    }
}

function submitForm() {
    const form = document.getElementById('registerForm');
    if (!form) {
        console.error('Form not found');
        return;
    }

    const formData = new FormData(form);
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                      form.querySelector('input[name="_token"]')?.value;

    if (!csrfToken) {
        console.error('CSRF token not found');
        alert('セキュリティトークンが見つかりません。ページを更新してください。');
        return;
    }

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            throw new Error(data.message || '不明なエラー');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (error.errors) {
            let errorMessage = 'バリデーションエラー:\n';
            for (let field in error.errors) {
                errorMessage += `${field}: ${error.errors[field].join(', ')}\n`;
            }
            alert(errorMessage);
        } else {
            alert('エラーが発生しました: ' + error.message);
        }
    });
}