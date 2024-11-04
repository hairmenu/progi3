Hello Progi,


# frontend
Front-end is built with  Vite + Vue3. It has not been dockerized so just "npm run dev" from <front-end> if you need to run it (node 22.11, npm v10.9).

# Backend
Back-end is based on symfony, it was dockersize so easier to run. "docker compose run" from root.

# Test
1. for front end: into <front-end> directory run "npx vitest"
2. for back end: run "docker exec -it be_progi_php php bin/phpunit"

Feel free to contact me at hairmenu@gmail.com if you need more details

Regards

