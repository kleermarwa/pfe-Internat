function fetchFloors() {
    let dormId = document.getElementById("dorm").value;
    let floorSelect = document.getElementById("floor");
    floorSelect.innerHTML = "<option>Loading...</option>";

    fetch("../ajax/fetch-floors.php?dorm_id=" + dormId)
        .then(response => response.json())
        .then(data => {
            floorSelect.innerHTML = "";
            data.forEach(floor => {
                let option = document.createElement("option");
                option.value = floor;
                option.text = "Floor " + floor;
                floorSelect.appendChild(option);
            });
        });
}

function fetchRooms() {
    let dormId = document.getElementById("dorm").value;
    let floor = document.getElementById("floor").value;
    let roomList = document.getElementById("room-list");
    roomList.innerHTML = "Loading...";

    fetch("../ajax/fetch-rooms.php?dorm_id=" + dormId + "&floor=" + floor)
        .then(response => response.json())
        .then(data => {
            roomList.innerHTML = "";
            data.forEach(room => {
                let roomDiv = document.createElement("div");
                roomDiv.className = "room-option";
                if (room.occupied_slots >= 4) {
                    roomDiv.classList.add("full");
                    roomDiv.innerHTML = `Room ${room.room_number} (Full)`;
                } else {
                    roomDiv.innerHTML = `Room ${room.room_number} (${room.occupied_slots}/4 occupied)`;
                    roomDiv.onclick = function() {
                        document.getElementById("selected-room").value = room.room_number;
                        document.querySelectorAll(".room-option").forEach(el => el.classList.remove("selected"));
                        roomDiv.classList.add("selected");
                    };
                }
                roomList.appendChild(roomDiv);
            });
        });
}
