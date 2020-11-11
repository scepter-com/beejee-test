    function createTask(usernameInput, emailInput, taskTextArea)
    {
        let username = $(usernameInput).val()
        let email = $(emailInput).val()



        let task = $(taskTextArea).val()
        let sendAllow = false

        if(username === "" || email === "" || task === "") {
            alert("Заполните поле все поля со звездочкой.")
            sendAllow = false
        } else {
            sendAllow = true
        }
        if (email.length > 0 && (email.match(/.+?\@.+/g) || []).length !== 1)
        {
            sendAllow = false
            alert('Вы ввели некорректный e-mail!');
        }
        if(sendAllow)
        {
            let body = "username=" + encodeURIComponent(username) + "&email=" + encodeURIComponent(email) + "&task=" + encodeURIComponent(task);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.origin + '/home/create', false);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(body);
            if(xhr.status != 200)
            {
                alert(xhr.status + ': ' + xhr.statusText);
            }
            else
            {
                window.location = window.location.href
                alert(xhr.response);
            }
        }
    }

    function updateTask(taskTextArea, id)
    {
        let task = $(taskTextArea).val()

        let sendAllow = false

        if(task === "") {
            sendAllow = false
        } else {
            sendAllow = true
        }
        if(sendAllow)
        {
            let body = "task=" + encodeURIComponent(task) + "&task_id=" + encodeURIComponent(id);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.origin + '/home/update', false);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(body);
            if(xhr.status != 200)
            {
                alert(xhr.status + ': ' + xhr.statusText);
            }
            else
            {
                let response = xhr.response;
                if(response === 'auth_error')
                {
                    window.location = '/admin';
                }
                else
                {
                    window.location = window.location.href
                    alert(xhr.response);
                }

            }
        }
    }

    function updateFulfilledStatus(fulfilledStatusSelect, id)
    {
        let ff = $(fulfilledStatusSelect).val()

        let sendAllow = false

        if(ff === "") {
            sendAllow = false
        } else {
            sendAllow = true
        }
        if(sendAllow)
        {
            let body = "fulfilled_status=" + encodeURIComponent(ff) + "&task_id=" + encodeURIComponent(id);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.origin + '/home/update', false);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(body);
            if(xhr.status != 200)
            {
                alert(xhr.status + ': ' + xhr.statusText);
            }
            else
            {
                let response = xhr.response;
                if(response === 'auth_error')
                {
                    window.location = '/admin';
                }
                else
                {
                    window.location = window.location.href
                    alert(xhr.response);
                }

            }
        }
    }
    function login(usernameInput, passwordInput)
    {
        let username = $(usernameInput).val()
        let password = $(passwordInput).val()
        let sendAllow = false

        if(username === "" || password === "") {
            alert("Заполните поле все поля со звездочкой.")
            sendAllow = false
        } else {
            sendAllow = true
        }

        if(sendAllow)
        {
            let body = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.origin + '/admin/login', false);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(body);
            if(xhr.status != 200)
            {
                alert(xhr.status + ': ' + xhr.statusText);
            }
            else
            {
                window.location = '/home';
                alert(xhr.response);
            }
        }
    }

