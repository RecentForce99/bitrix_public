<form class="pop-up__form feedback-simple-ajax" method="post">
    <div class="pop-up__title-box">
        <div class="pop-up__title">Обратный звонок</div>
    </div>
    <div class="pop-up__error feedback-simple errortext-name"></div>
    <label class="pop-up__label">
        <input required name="NAME" placeholder="Ваше имя" type="text" class="pop-up__input">
    </label>
    <div class="pop-up__error feedback-advanced errortext-phone"></div>
    <label class="pop-up__label">
        <input required name="PHONE" placeholder="Ваш телефон с кодом региона" type="tel" class="pop-up__input">
    </label>
    <div class="pop-up__error">Телефон введен неверно</div>
    <div class="pop-up__btn-box">
        <button type="submit" class="pop-up__btn complete">
            <span>Отрпавить</span>
            <span class="pop-up__btn-icon">
                            <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.83333 1.33398L6 5.50065L1.83333 9.66732" stroke="#0199E4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
        </button>
        <div class="pop-up__personal-data">
            При нажании на «Отправить» вы согласие на обработку персональных данных
        </div>
    </div>
</form>