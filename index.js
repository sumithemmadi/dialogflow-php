/*
                                 Apache License
                           Version 2.0, January 2004
                        http://www.apache.org/licenses/

   Copyright 2021 sumithemmadi

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.


*/
function sendJSON() {
	let result = document.querySelector('.result');
	let sender = document.querySelector('#sender');
	let message = document.querySelector('#message');
	let xhr = new XMLHttpRequest();
	let url = "/dialogflow.php";

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-Type", "application/json");

	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4 && xhr.status === 200) {

			result.innerHTML = this.responseText;
		}
	};

	var data = JSON.stringify({
		"sender": sender.value,
		"message": message.value
	});
	xhr.send(data);
}
