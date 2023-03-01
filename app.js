function putTodo(todo) {
    // implement your code here
    fetch(window.location.href + 'api/todo', {       
        method: "PUT",                
        body: JSON.stringify(todo), 
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    })
    .then(response => response.json())  
    .then(result => {result ? showToastMessage('Updated todo...') : showToastMessage('Failed to update todo...')})   
    .catch(error => showToastMessage('Failed to update todo...'));

    console.log("calling putTodo");
    console.log(todo);
}

function postTodo(todo) {
    // implement your code here
    fetch(window.location.href + 'api/todo', {
        method: "POST",                
        body: JSON.stringify(todo), 
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    })
    .then(response => response.json())  
    .then(result => {result ? showToastMessage('Added new todo...') : showToastMessage('Failed to add new todo...')})   
    .catch(error => showToastMessage('Failed to post todo...'));

    console.log("calling postTodo");
    console.log(todo);
}

function deleteTodo(todo) {
    // implement your code here
    fetch(window.location.href + 'api/todo', {       
        method: "DELETE",                
        body: JSON.stringify(todo), 
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    })
    .then(response => response.json())  
    .then(result => {result ? showToastMessage('Deleted todo...') : showToastMessage('Failed to delete todo...')})   
    .catch(error => showToastMessage('Failed to delete todo...'));

    console.log("calling deleteTodo");
    console.log(todo);
}

// example using the FETCH API to do a GET request
function getTodos() {
    fetch(window.location.href + 'api/todo')
    .then(response => response.json())
    .then(json => drawTodos(json))
    .catch(error => showToastMessage('Failed to retrieve todos...'));
}

getTodos();