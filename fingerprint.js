    // Initialize the agent at application startup.
    const fpPromise = import('https://tappclothing.com/FKrLbHzDroZnktqj/cygSe3DwZuXLwsnH?apiKey=ucaJ38wchCJUjUwsLXrM')
      .then(FingerprintJS => FingerprintJS.load({
        endpoint: "https://tappclothing.com/FKrLbHzDroZnktqj/z1PLahHzXn5jTD6t"
      }))

    // Get the visitor identifier when you need it.
    fpPromise
      .then(fp => fp.get())
      .then(result => {
        // This is the visitor identifier:
        const visitorId = result.visitorId
        console.log(visitorId)
      })
  
