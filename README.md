# We Build

## What is We Build? 
We Build is a web-based platform that allows developers to collaborate on projects together. The platform enables users to form teams, manage their projects and teams, and track their progress in a global leaderboard. My motivation for this project came from the realization that landing your first job as a developer can be challenging, especially when you don't have any real-world experience. That's where We Build comes in, providing an opportunity for developers of all experience levels to come together to build projects they are passionate about while gaining valuable teamwork and software development experience. The platform is constantly evolving and updated on my Github repository.

### Main Concepts: 
Projects can be in three phases. 
1. Open: 
2. In Progress
3. Completed

Open Phase: 
- User creates a project ide
- Project description outlines what the project is and who they are looking for to join their team
- Other users can apply to the project
- Project owner can view all applications and select who they're looking for
- Project owner can contact applicants through the site to “interview them”
- The project owner accepts the applicant and this applicant can now view details of the project
- Whenever the project owner feels like they are ready they may "Start" their project which involves submitting a deadline and confirming the team for the project. From this point on the team has full autonomy to conduct themselves as they wish.

WIP Phase: 
- The team is actively building the project

Completed Phase:
- Once the project is completed the owner submits the project
- The owner writes out a final description of the project and provides some links to code and demo of the project
- If a project is submitted ahead of the deadline the project gets a multiplier effect on the votes it receives 
- If the project is submitted after the deadline there is no multiplier
- After submission team members are asked to rate the individuals on their team
- Users either upvote the project when it is completed

### Leaderboards:
- Two leaderboards 1. Project. 2. User
- Project leaderboard is for the best project based on how many votes a project gets
- User leaderboards are for the best team member based on the total amount of votes that user's projects have received as well as how their teammates ranked them

## Current Progress
Currently working on MVP.
Percent complete: 80%

## Upcoming features


## Installation Steps: 
1. clone the repo 

2. Run the following to install dependencies
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

3. copy env file
`cp .env.example .env`
replace `DB_HOST` with `mysql`
replace `DB_USERNAME` with `sail`
replace `DB_PASSWORD` with a password of your choosing
replace `REDIS_HOST` with `redis`
replace `MEMCACHED_HOST` with `memcached`

4. bring up container `./vendor/bin/sail up -d` or if you have a sail alias set up `sail up -d`
5. generate key `sail php artisan key:generate`
6. install frontend dependencies `sail npm install`
7. run migrations `sail php artisan migrate`
8. run dev frontned dev server `sail npm run dev`
9. go to `localhost` on browser
