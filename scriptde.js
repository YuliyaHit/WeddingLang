let a = document.querySelectorAll('.form__decision'),
	c = document.getElementsByClassName("wrapper-form")[0],
	child = document.querySelector('.form__children'),
	guestPreferences = document.getElementsByClassName('guest_preferences')[0],
	partnerPreferences = document.getElementsByClassName('partner_preferences')[0],
	choicePartner = document.querySelectorAll('.form__choice_partner'),
	pfood3 = document.getElementById('pfood3'),
	form = document.getElementById('form'),
	mainForm = document.getElementsByClassName('main__form')[0],
	mainQuestion = document.getElementsByClassName('main__question')[0],
	groupChildren =document.querySelector('.wrapper-form-children'),
	button = document.getElementsByClassName('form__button')[0],
    section1 = document.getElementsByClassName('s1')[0],
    section2 = document.getElementsByClassName('s2')[0],
    foto3 = document.getElementsByTagName("img")[2],
    thanks = document.getElementsByClassName('thanks')[0];


for (let i = 0; i< a.length; i++) {
	a[i].addEventListener('change', function() {
		profile();		
	});
}

for (let i = 0; i< choicePartner.length; i++) {
	choicePartner[i].addEventListener('change', function() {
		if (choicePartner[1].checked) {
			guestPreferences.style.display = "none";
			partnerPreferences.style.display = "block";
			pfood3.getElementsByTagName('span')[0].innerHTML = "Er ist Vegetarier";
		}else if( choicePartner[2].checked) {
			guestPreferences.style.display = "none";
			partnerPreferences.style.display = "block";
			pfood3.getElementsByTagName('span')[0].innerHTML = "Sie ist Vegetarierin";
		}else {
			partnerPreferences.style.display = "none";
			guestPreferences.style.display = "block";
		}	
	});
}

function profile() {
	(a[0].checked || a[1].checked)?(c.style.display = "block"):(c.style.display = "none");
};

child.addEventListener('change', function() {
	(child.checked)?(groupChildren.style.display = "block"):(groupChildren.style.display = "none");
});

function deadTimer() {
    let end  = '2021-12-15';
if((Date.parse(end) - Date.parse(new Date()))<= 0) {
    button.setAttribute('disabled', 'disabled');
    console.log('Ты не успел красавчик');
    }
}

button.addEventListener('click', deadTimer());

function hideForm() {
    if(thanks && thanks.textContent == 'Sehr schade, dass du nicht anwesend sein kannst') {
		mainQuestion.style.display = 'none';
		button.style.display = 'none';
		section1.style.display = 'none';
		section2.style.display = 'none';
		foto3.style.display = 'none';
		thanks.style.margin = '30% auto 10px';
		thanks.style.textAlign = 'center';
		form.style.cssText +='height: 100vh; width: 100%; margin: 0';
		mainForm.style.marginBottom = "0";
    } else if (thanks && thanks.textContent == 'Herzlichen Dank für deine Angaben!') {
		mainQuestion.style.display = 'none';
		button.style.display = 'none';
		section1.style.display = 'none';
		foto3.setAttribute('src', 'images/foto5.jpg');
		mainForm.style.cssText +='display: flex; flex-direction: column; align-items: center';
		foto3.style.width = '100%';
		form.style.width = '90%';
		thanks.style.margin = '10px auto 10px';
    }
}

hideForm();
//Timer

    let deadline = '2022-09-17';

    function getTimeRemaining(endtime) {
            let t = Date.parse(endtime) -  Date.parse(new Date()),
                seconds = Math.floor((t/1000) % 60),
                minutes = Math.floor((t/1000/60) % 60),
                hours = Math.floor((t/(1000*60*60)) % 24),
                days = Math.floor((t/(1000*60*60*24)));

            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds':  seconds
            };
    }

    function setClock (id, endtime) {
        let timer = document.getElementById(id),
        	days = timer.querySelector('.days'),
            hours = timer.querySelector('.hours'),
            minutes = timer.querySelector('.minutes'),
            seconds = timer.querySelector('.seconds'),
            timeInterval = setInterval(updateClock, 1000);

            function updateClock() {
                let t = getTimeRemaining(endtime);

               function addZero(num){
                        if(num <= 9) {
                            return '0' + num;
                        } else return num;
                    };
            days.textContent = addZero(t.days);       
            hours.textContent = addZero(t.hours);
            minutes.textContent = addZero(t.minutes);
            seconds.textContent = addZero(t.seconds);

            if (t.total <= 0) {
                clearInterval(timeInterval);
                days.textContent = '00';
                hours.textContent = '00';
                minutes.textContent = '00';
                seconds.textContent = '00';

                }
            }
    }

    setClock('timer', deadline);
