# Orange Digital Coding Test by James Miller

## Data retrieval process
1. Validate dates that are being parsed through
2. Check the cache and see if we have that data already before making a request
3. Any data we don't have, we need to get from the source
..* Need to check connection,and if not present display last updated date.
4. Display the data using JQuery Datatables

## Cache
* Cache will be stored by Year and Number of names. It is assumed we will be using the same parameters for the number as stated on the website. However, we can search for any number.
* Data will be stored as JSON to give good storage and better performance on the table.
* If the connection to the website is down, we need to not overwrite what is in place.
* Need to store a last updated date incase there are issues with data validity that can then be checked later.