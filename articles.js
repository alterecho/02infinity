class ArticlesPage {

    onLoad() {
        let articlesJSON = currentPage.fetchArticles()
        console.log("articles: ", articlesJSON);

        let articlesListElement = document.getElementById("list-articles");
        console.log("articlesListElement: ", articlesListElement);
        var listHTML = "<ul>";
        articlesJSON.forEach(article => {
            listHTML += `<li><a href=${article.url}>${article.title}</a></li>`
        });
        listHTML += "</ul>"
        articlesListElement.innerHTML = listHTML;
    }

    fetchArticles(params) {
        const articles = [
            {
                "title": "<code>Understanding</code> Swift Opaque types",
                "url": "https://02infinity.medium.com/really-understanding-swift-some-keyword-and-swift-opaque-types-consequently-ae87b3e2efe4",
            },
            {
                "title": "Understanding Swift protocol's associated types",
                "url": "https://02infinity.medium.com/understanding-swift-protocol-associated-types-ca717d091b56",
            },
            {
                "title": "Swift's mutating and non-mutating keywords",
                "url": "https://02infinity.medium.com/swifts-mutating-and-nonmutating-keywords-db49adbdcf1c",
            },
            {
                "title": "Understanding Swift’s @unknown and @frozen attribute",
                "url": "https://02infinity.medium.com/understanding-swifts-unknown-and-frozen-attribute-f9801ae3b97e"
            }
        ];
        return articles;
    }
}

currentPage = new ArticlesPage()
