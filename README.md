# We Build

## What is we build? 
We build is a platform where developers can come together to collaborate on projects. 

### Main Concepts: 
Projects can be in three phases. 
1. An idea: 
2. WIP
3. Completed

Idea Phase: 
- User creates a project idea
- Idea outlines, what, why, and who they are looking for to join their team
- Other users apply to project 
- Project owner filters through applicants and finds who they are looking 
- Project owner can contact applicant through site to “interview them”
- Project owner accepts applicant and this applicant can now view details of the project
- Once all spots have been filled. Applications closed. Project owner submits a deadline for the project. From this point on the team has full autonomy to conduct themselves as they wish.

WIP Phase: 
- Team is actively building project 
- They have until the deadline to submit the project

Completed Phase:
- Once the project is completed the owner submits the project
- The team writes out a final description of the project and provides some links to code and demo of the project
- If project is submitted by the deadline they get a they get a multiplier effect on the votes they receive 
- If the project is submitted after the deadline they lose X amount of points per day (projects can go into the negatives) 
- After submission team members are asked to rate the individuals on their team
- Users either upvote or down vote the project when it is completed

### Leaderboards:
- Two leaderboards 1. Project. 2. User
- Project leaderboard is for the best project based on how many votes a project gets
- User leaderboards is for the best team member based on how your teammates ranked you 

## User Flows
### User Flow (Owner):
- Owner views the projects decides they don’t like any of them and have their own idea they want to make 
- Sign up for an account 
- Go to projects view and click “create a new project”
- Write out project details and submit project
- View their project dashboard, make any changes that are needed
- Wait for applicants 
- View applications 
- Accept/ reject applications until team is filled or owner feels they are ready to start the project 
- Click “start project”
- Work on project 
- From project dash board click “complete project”
- Fill out desc. Provide links to code and demo

### User Flow (Applicant): 
- User views project 
- User reads description 
- User clicks “apply”
- Writes out their application and why they should be a part of the project
- Waits for acceptance 
- When accepted user can view project dash board

## Current Progress
Currenlty working on the MVP.

## Upcoming features


## Instalation Steps: 
1. clone repo 

2. Run the following to install dependecies
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
