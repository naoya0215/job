//エリアごとに表示変更
document.addEventListener('DOMContentLoaded', () => {
    //要素を取得
    const kantoErea =  document.getElementById('kanto');
    const kansaiErea =  document.getElementById('kansai');
    const tokaiErea =  document.getElementById('tokai');
    const tohokuErea =  document.getElementById('tohoku');
    const hokurikuErea =  document.getElementById('hokuriku');
    const chugokuErea =  document.getElementById('chugoku');
    const shikokuErea =  document.getElementById('shikoku');
    const kyushiuErea =  document.getElementById('kyushiu');
    const areaall = document.querySelector('.area');
    const kantoall = document.querySelectorAll('.area_kanto');
    const kansaiall = document.querySelectorAll('.area_kansai');
    const tokaiall = document.querySelectorAll('.area_tokai');
    const tohokuall = document.querySelectorAll('.area_tohoku');
    const hokurikuall = document.querySelectorAll('.area_hokuriku');
    const chugokuall = document.querySelectorAll('.area_chugoku');
    const shikokuall = document.querySelectorAll('.area_shikoku');
    const kyushiuall = document.querySelectorAll('.area_kyushiu');
    const kantoback = document.querySelectorAll('#kanto_back');
    const kansaiback = document.querySelectorAll('#kansai_back');
    const tokaiback = document.querySelectorAll('#tokai_back');
    const tohokuback = document.querySelectorAll('#tohoku_back');
    const hokurikuback = document.querySelectorAll('#hokuriku_back');
    const chugokuback = document.querySelectorAll('#chugoku_back');
    const shikokuback = document.querySelectorAll('#shikoku_back');
    const kyushiuback = document.querySelectorAll('#kyushiu_back');

    //関東エリア
    kantoErea.addEventListener('click', () => {
        areaall.style.display = 'none';
        kantoall.forEach(element => {
            element.style.display = 'block';
        });
    });

    //エリアへ戻る(関東)
    kantoback.forEach(backButton => {
        backButton.addEventListener('click', () => {
            areaall.style.display = 'block';
            kantoall.forEach(element => {
                element.style.display = 'none';
            });
        });
    });


    //関西エリア
    kansaiErea.addEventListener('click', () => {
        areaall.style.display = 'none';
        kansaiall.forEach(element => {
            element.style.display = 'block';
        });
    });

    //エリアへ戻る(関西)
    kansaiback.forEach(backButton => {
        backButton.addEventListener('click', () => {
            areaall.style.display = 'block';
            kansaiall.forEach(element => {
                element.style.display = 'none';
            });
        });
    });


    //東海エリア
    tokaiErea.addEventListener('click', () => {
        areaall.style.display = 'none';
        tokaiall.forEach(element => {
            element.style.display = 'block';
        });
    });

    //エリアへ戻る(東海)
    tokaiback.forEach(backButton => {
        backButton.addEventListener('click', () => {
            areaall.style.display = 'block';
            tokaiall.forEach(element => {
                element.style.display = 'none';
            });
        });
    });


    //東北エリア
    tohokuErea.addEventListener('click', () => {
        areaall.style.display = 'none';
        tohokuall.forEach(element => {
            element.style.display = 'block';
        });
    });

    //エリアへ戻る(東北)
    tohokuback.forEach(backButton => {
        backButton.addEventListener('click', () => {
            areaall.style.display = 'block';
            tohokuall.forEach(element => {
                element.style.display = 'none';
            });
        });
    });


    //北陸エリア
    hokurikuErea.addEventListener('click', () => {
        areaall.style.display = 'none';
        hokurikuall.forEach(element => {
            element.style.display = 'block';
        });
    });

    //エリアへ戻る(北陸)
    hokurikuback.forEach(backButton => {
        backButton.addEventListener('click', () => {
            areaall.style.display = 'block';
            hokurikuall.forEach(element => {
                element.style.display = 'none';
            });
        });
    });


    //中国エリア
    chugokuErea.addEventListener('click', () => {
        areaall.style.display = 'none';
        chugokuall.forEach(element => {
            element.style.display = 'block';
        });
    });

    //エリアへ戻る(中国)
    chugokuback.forEach(backButton => {
        backButton.addEventListener('click', () => {
            areaall.style.display = 'block';
            chugokuall.forEach(element => {
                element.style.display = 'none';
            });
        });
    });


    //四国エリア
    shikokuErea.addEventListener('click', () => {
        areaall.style.display = 'none';
        shikokuall.forEach(element => {
            element.style.display = 'block';
        });
    });

    //エリアへ戻る(四国)
    shikokuback.forEach(backButton => {
        backButton.addEventListener('click', () => {
            areaall.style.display = 'block';
            shikokuall.forEach(element => {
                element.style.display = 'none';
            });
        });
    });


    //九州エリア
    kyushiuErea.addEventListener('click', () => {
        areaall.style.display = 'none';
        kyushiuall.forEach(element => {
            element.style.display = 'block';
        });
    });

    //エリアへ戻る(九州)
    kyushiuback.forEach(backButton => {
        backButton.addEventListener('click', () => {
            areaall.style.display = 'block';
            kyushiuall.forEach(element => {
                element.style.display = 'none';
            });
        });
    });
});