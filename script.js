let a = document.querySelectorAll('.form__decision'),
	c = document.getElementsByClassName("wrapper-form")[0],
	child = document.querySelector('.form__children'),
	guestPreferences = document.getElementsByClassName('guest_preferences')[0],
	partnerPreferences = document.getElementsByClassName('partner_preferences')[0],
	choicePartner = document.querySelectorAll('.form__choice_partner'),
	groupChildren =document.querySelector('.wrapper-form-children');

	console.log(a);
	console.log(c);
	console.log(child);
	console.log(groupChildren);
	console.log(guestPreferences);
	console.log(partnerPreferences);
	console.log(choicePartner);

for (let i = 0; i< a.length; i++) {
	a[i].addEventListener('change', function() {
		profile();		
	});
}

for (let i = 0; i< choicePartner.length; i++) {
	choicePartner[i].addEventListener('change', function() {
		if (choicePartner[1].checked || choicePartner[2].checked) {
			guestPreferences.style.display = "none";
			partnerPreferences.style.display = "block";
		}	else {
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

//for partners choice


