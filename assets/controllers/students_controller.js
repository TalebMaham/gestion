import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {

    static values = {
        url: String ,
    };

    static targets = ['result'];
    connect() {
        
    console.log("connecter !"); 
    }


    onSearchInput(event) {
        this.laction(event.currentTarget.value);
    }

  async  laction(query)
    {
        if (query.length > 2) {
            const params = new URLSearchParams({
                q: query,
                preview: 1,
            });
       //const response = await fetch('/prof/1'); 
       const response = await fetch(`/prof_searchSelect?${params.toString()}`);
       this.resultTarget.innerHTML = await response.text();
        }
        else{
            this.resultTarget.innerHTML = '';
        }


    }

    async onChangePresenceClick(event) {

        console.log('is connected'); 
        let isPresent = event.currentTarget.dataset.entryPresence;
        let eleve_id = event.currentTarget.dataset.entryEleveid;
        console.log(eleve_id);
        $('#is-present_' + eleve_id).prop("disabled", true);
        const params = new URLSearchParams({
            eleve_id: eleve_id,
            is_present: isPresent
        });
        const response = await fetch(`${this.urlValue}?${params.toString()}`);
        let data = await response.json();
        console.log(data) ;
        if (await data.success) {
            if (await data.status == "Present") {
                console.log(data.status)
                this.resultTarget.src = 'images/toggle-on-solid.svg';
                $('#is-present_' + eleve_id).attr('data-entry-presence', 'on');
                $('#eleve-status_' + eleve_id).attr('style', 'color: #34A84F');
                $('#eleve-status_' + eleve_id).text('Present')
            } else if (await data.status == "Absent") {
                this.resultTarget.src = 'images/toggle-off-solid.svg';
                $('#is-present_' + eleve_id).attr('data-entry-presence', 'off');
                $('#eleve-status_' + eleve_id).attr('style', 'color: #FF2E2E');
                $('#eleve-status_' + eleve_id).text('Absent')
            }
            $('#is-present_' + eleve_id).prop("disabled", false);
        }
    }
 
}