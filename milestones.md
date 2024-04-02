# Milestones

## List of Updates
- *11/3* - Updated to basic functionality
- *23/3* - Added post status and logic to move between statuses
- *25/3* - Added tags to thoughts
- *26/3* - Wanted to punch myself but got the notifications working

## Function List and Steps

### Search Page
A single click button will bring up a modal for putting in text to search for thoughts by content (at this point). The
results will be listed by date. (We are NOT doing any of that potato math here, good sir. Get to france)

  - [ ] Make Results Page
  - [ ] Make Search Modal
  - [ ] Controller Logic - Find Posts containing word
  - [ ] Test

#### Tests
  - [ ] Results Page Can be Displayed
  - [ ] Modal Can Appear
  - [ ] Modal Can Accept input
  - [ ] The Results Page Can be Displayed with returned values
  - [ ] Above and values are correct

### Notifications
When a posting event occurs (a user creates a thought, edits a thought, moves a thought or permanently deletes it), the
system will pass a message telling the user the action has occurred successfully (or otherwise)
  - [x] Make Notification component
  - [x] Make Notification logic in the page (IE: When the controller returns a message, use the notification component
  to display it)
  - [x] Test Notification logic

### Tags (DONE: 25/3)
Each thought can have three, one word tags. The tags can be added via a model and removed by clicking on the tag.
  - [x] *Make Migration* - Add tags field to Thoughts table, Add Tags Table
  - [x] *View* - Display tags on the thought page
  - [x] *Logic* - Add tag creation logic

### Drafts
The draft page will list a page of thoughts

  - [x] *Make Migration* - Add status field to Thought Migration
  - [x] *View* - Displays Thoguhts with all three statuses
  - [x] *Routes* - Add routes for Logic
  - [x] *Logic* - Add logic to move thoughts
    - [x] *Drafts* - Move to Posted and Deleted
    - [x] *Posted* - Move to Drafts and Deleted
    - [x] *Deleted* - Move to Posted, Drafts, and allow for Permanant Deletion

## Version Milestones

### Version 1
- [x] *Post Drafts*: Allow users to save drafts of their posts.
- [x] *Tagging/Categories*: Allow users to categorize or tag their posts. This can help with organization and searchability.
- [x] *Notifications* : Notify users when events occur (post published, deleted, etc.).
- [ ] *Search Functionality*: Allow users to search their own posts using keywords or tags.

### Version 2
- [ ] *Rich Text Editing*: Allow users to format their posts with options like bold, italic, underline, lists, etc.
- [ ] *Media Uploads*: Allow users to upload images or videos to their posts.
- [ ] *Post Scheduling*: Allow users to schedule posts to be published at a specific time.

### Version 3
- [ ] *Privacy Settings*: Allow users to set privacy levels for their posts (public, private, friends only, etc.).
- [ ] *Profile Customization*: Allow users to customize their profile with a bio, profile picture, cover photo, etc.

### Version 4
- [ ] *Pagination*: Allow users to paginate their posts to avoid long scrolling.
- [ ] *Live Load*: Allow users to see new posts without refreshing the page.

### Version 5
- [ ] *Stories* : Allow users to organize their posts into stories or collections.
