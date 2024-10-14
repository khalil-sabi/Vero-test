let myTasks = []
async function fetchTasks() {
    try {
        response = await fetch('data');
        data = await response.json();
        myTasks = data;
        return data

    } catch (error) {
        console.error('Error fetching tasks:', error);
    }
}

async function populate_table(){
    data = await fetchTasks();
    taskBody = document.getElementById('taskBody');
    if(data){
        refresh_table(data);
    }else{
        taskBody.innerHTML = '<tr><td colspan="4">empty</td></tr>';
    }
}

function refresh_table(tasks){
    taskBody = document.getElementById('taskBody');
    taskBody.innerHTML = '';
    tasks.forEach(task => {
                    row = document.createElement('tr');
                    taskCell = document.createElement('td');
                    taskCell.textContent = task.task;

                    titleCell = document.createElement('td');
                    titleCell.textContent = task.title;

                    descriptionCell = document.createElement('td');
                    descriptionCell.textContent = task.description; 

                    colorCodeCell = document.createElement('td');
                    colorDiv = document.createElement('div');
                    colorDiv.className = 'color-code';
                    colorDiv.style.backgroundColor = task.colorCode;
                    colorCodeCell.appendChild(colorDiv);

                    // insert cells in row
                    row.appendChild(taskCell);
                    row.appendChild(titleCell);
                    row.appendChild(descriptionCell);
                    row.appendChild(colorCodeCell);
                    //insert row in table body
                    taskBody.appendChild(row);
                });
}

function searchBarFunc() {
    searchTerm = document.getElementById('searchBar').value.toLowerCase();
    filteredTasks = myTasks.filter(item => 
        item.task.toLowerCase().includes(searchTerm) ||
        item.title.toLowerCase().includes(searchTerm) ||
        item.description.toLowerCase().includes(searchTerm)
    );
    refresh_table(filteredTasks);
}

document.getElementById('imageInput').addEventListener('change', function(event) {
    file = event.target.files[0];
    previewImg = document.getElementById('previewImg');

    if (file) {
        reader = new FileReader();

        //display image
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewImg.classList.remove('d-none');
        };

        reader.readAsDataURL(file); // Read the image file as a data URL
    }
});


document.getElementById('searchBar').addEventListener('input', searchBarFunc);
window.onload = populate_table;

const interval = setInterval(function() {
    populate_table();
    console.log("refreshed");
}, 3600000); 


