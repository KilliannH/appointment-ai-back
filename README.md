// api routes :

[POST]

/songs
{"title", "path", "artistId"[], "albumId"[]}

/artists
{"name"}

/albums
{"title", "img_url", "artistId"[]}

[PUT]

/songs/{id}
{"title", "path"}

    [DETACH]
    /songs/{id}/detach/artists
    {"artistId"[]}
    
    /songs/{id}/detach/albums
        {"albumId"[]}
    
    [ATACH]
        /songs/{id}/atach/artists
        {"artistId"[]}
        
        /songs/{id}/atach/albums
            {"albumId"[]}
            
/artists/{id}
{"name"}

    [DETACH]
    /artists/{id}/detach/albums
    {"albumId"[]}
    
    [ATACH]
     /artists/{id}/atach/albums
     {"albumId"[]}

/albums
{"title", "img_url"}

    [DETACH]
    /albums/{id}/detach/artists
    {"artistId"[]}
    
    [ATACH]
     /albums/{id}/atach/artists
     {"artistId"[]}

[DELETE]

/songs/{id}
/artists/{id}
/albums/{id}

* delete also remove relation(s)

[GET]

* get will always return associated fields

/songs
/songs/{id}

/artists
/artists/{id}

/albums
/albums/{id}


Scenario : User creates an artist,
then creates an album wth artistId attached,
then creates a song with artistId & albumId attached.

----------------------

TODO - use app and make tests.