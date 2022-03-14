const endpoint = '/wp-json/wp/v2/people';
	
const team = [];
const teamCont = document.querySelector('#team');
const searchCont = document.querySelector('#search-wrapper')
const searchbar = document.querySelector('#search');
if (searchbar) searchbar.value = '';

if (searchbar) searchbar.addEventListener('input', updateSearch);

if (teamCont) teamCont.addEventListener('click', handleClick);

function fetchTeamMembers(endpoint) {
  fetch(endpoint)
    .then(res => {
      return res.json();
    })
    .then(data => {
      teamCont.innerHTML = '';
      data.forEach( member => {
        const imgURL = fetch(`http://prototype.imaginalmarketing.net/wp-json/wp/v2/media/${member.featured_media}`)
            .then(res => res.json())
            .then(imgDetails => imgDetails.media_details.sizes.medium.source_url)
            .then( url => {
              const teamMember = {
                name: member.title.rendered,
                bio: member.content.rendered,
                url: url,
                slug: member.slug,
                menu_order: member.menu_order
              }
              team.push(teamMember)
              generateHTML(teamMember)
            })
      })
    })
}
if (teamCont) fetchTeamMembers(endpoint);

function generateHTML(teamMember) {
  const html = `<div class="team-member" data-slug="${teamMember.slug}">
    <a class="member-link" href="#${teamMember.slug}"><img src="${teamMember.url}" alt="${teamMember.name} pic" />
    <h3>${teamMember.name}</h3></a></div>
  `;
  teamCont.insertAdjacentHTML('beforeend', html);
}

function generateDetailedBio(teamMember) {
  const html = `<a class="button back-btn" href="#" role="button"><< back</a>
    <div class="team-member-detailed row" data-slug="${teamMember.slug}">
    <div class="team-member-img medium-6"><img src="${teamMember.url}" alt="${teamMember.name} pic" /></div>
    <div class="team-member-bio medium-6">
    <h3>${teamMember.name}</h3>
    ${teamMember.bio}</div></div>
  `;
  teamCont.insertAdjacentHTML('beforeend', html);
}

function handleClick(e) {
  e.preventDefault();
  if (e.target == document.querySelector('.back-btn')) {
    goBack();
    return
  }
  if (!e.target.closest('a.member-link')) return;
  
  const selectedSlug = e.target.closest('.team-member').dataset.slug;
  console.log(`Selected Team Member's Slug: ${selectedSlug}`)
  teamCont.innerHTML = '';
  window.scrollTo({
    top: document.querySelector('header').getBoundingClientRect().height,
    left: 0,
    behavior: 'smooth'
  });
  const selectedTeamMember = team.find( mem => mem.slug == selectedSlug);
  searchCont.style.display = 'none';
  teamCont.classList.add('single');
  generateDetailedBio(selectedTeamMember);
}

function updateSearch(e) {
  const value = e.target.value
  const filteredResults = team.filter(member => member.name.toLowerCase().includes(value.toLowerCase()))
  teamCont.innerHTML = '';
  filteredResults.forEach( mem => generateHTML(mem));
}

function goBack() {
  searchCont.style.display = 'block';
  teamCont.classList.remove('single');
  teamCont.innerHTML = '';
  team.forEach(mem => generateHTML(mem));
}