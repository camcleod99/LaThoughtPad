# Milestones
  
## Threads

As a "Single player" microblog. I want to make threads  

- [ ] Add to Migration of Posts
  - Link To 
  - Link From
- [ ] Add a button to "Link to" posts and a copy-paste of post-id's
- [ ] Thread View
  - [ ] How to do this? 
    - Find Post - Let's call this "actualPost"
    - Before Loop 
      - ```
        - While post -> link from (Parent)
          - push post to "before"
        - while post -> link to (child)
          - push post to "after"
        ```
    - Display Posts
      - ```
        - for each before as beforePost
          (display beforePosts)
        - post actual post
        - for each after as afterPost
          (display afterPosts)
        ```