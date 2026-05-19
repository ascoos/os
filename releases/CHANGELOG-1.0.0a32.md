# ASCOOS OS - Changelog for 1.0.0a32

Date: **2026-05-18 19:00:00**

Build: **17800**

State: **Alpha-32**


---

## Classes

### **TMathHandler**

**Changes:**

- Updates many methods
- Added new methods (17786)

**Methods:**

- **`areaOfCubic()`** : Computes the total surface area of a cube from the length of its side.
- **`areaOfRegularOctagon()`** : Computes the area of a regular octagon from the length of its side.
- **`binet_fibonacci()`** : Computes the n-th Fibonacci number using Binet’s closed-form formula.


---

### **TMathGraphHandler**

This class extends TMathHandler and introduces graph‑related algorithms, including single‑source and all‑pairs shortest path methods.

**Changes:**

- Added new methods (Initial)

**Methods:**

- **`__construct()`** : Initializes the TMathGrpahHandler instance with optional array data and properties.
- **`getInstance()`** : Returns the existing TMathGraphHandler instance or creates a new one if none exists.
- **`articulationPoints()`** : Finds all articulation points in an undirected graph using Tarjan’s algorithm.
- **`assortativity()`** : Computes the degree assortativity coefficient of an undirected graph.
- **`averagePathLength()`** : Computes the average shortest‑path length of an undirected graph.
- **`bellmanFord()`** : Computes shortest paths from a single source using the Bellman-Ford algorithm.
- **`betweennessCentrality()`** : Computes the betweenness centrality of all vertices using Brandes' algorithm.
- **`bfs()`** : Performs a Breadth‑First Search (BFS) traversal from a given source node.
- **`biconnectedComponents()`** : Computes all biconnected components (BCCs) of an undirected graph.
- **`bridges()`** : Finds all bridges in an undirected graph using Tarjan’s algorithm.
- **`bronKerbosch()`** : Enumerates all maximal cliques of an undirected graph using the Bron–Kerbosch algorithm.
- **`bronKerboschNoPivot()`** : Classical Bron–Kerbosch recursive algorithm without pivoting.
- **`bronKerboschPivot()`** : Recursive Bron–Kerbosch variant with pivoting (Tomita optimization).
- **`canReach()`** : Checks whether a target node is reachable from a source node in a directed graph.
- **`cliqueNumber()`** : Computes the clique number (size of a maximum clique) of an undirected graph.
- **`closenessCentrality()`** : Computes the closeness centrality of all vertices in an undirected graph.
- **`clusteringCoefficient()`** : Computes the global clustering coefficient of an undirected graph.
- **`componentOf()`** : Returns the connected component that contains the specified node.
- **`condensationGraph()`** : Constructs the condensation graph (SCC DAG) from a directed graph and its SCCs.
- **`connectedComponents()`** : Finds all connected components in an undirected graph.
- **`coreDecomposition()`** : Computes the core number (coreness) of each vertex in an undirected graph.
- **`degeneracy()`** : Computes the degeneracy of an undirected graph.
- **`degree()`** : Returns the degree of a node in an undirected graph.
- **`degreeCentrality()`** : Computes the degree centrality of all vertices in an undirected graph
- **`dfs()`** : Performs a Depth‑First Search (DFS) traversal from a given source node.
- **`diameter()`** : Computes the diameter of an undirected graph.
- **`dijkstra()`** : Computes shortest paths from a single source using Dijkstra’s algorithm.
- **`eccentricity()`** : Computes the eccentricity of a vertex in an undirected graph.
- **`edgeConnectivity()`** : Computes the edge connectivity λ(G) of an undirected graph.
- **`edgeCount()`** : Counts the total number of edges in the graph.
- **`edgeRemovalImpact()`** : Computes the structural impact of removing each edge from the graph.
- **`edmondsKarp()`** : Computes the maximum flow in a directed graph using the Edmonds–Karp algorithm.
- **`eigenvectorCentrality()`** : `Computes eigenvector centrality using the power‑iteration method.
- **`fiedlerJacobiEigenvalues()`** : Computes all eigenvalues of a real symmetric matrix using the classical Jacobi rotation method.
- **`fiedlerValue()`** : Computes the Fiedler value (algebraic connectivity) of an undirected graph.
- **`floydWarshall()`** : Computes all‑pairs shortest paths using the Floyd-Warshall algorithm.
- **`fordFulkerson()`** : Computes the maximum flow in a directed graph using the classical Ford–Fulkerson method.
- **`globalClustering()`** : Computes the global clustering coefficient (transitivity) of an undirected graph.
- **`graphDensity()`** : Computes the density of an undirected graph.
- **`johnson()`** : Computes all‑pairs shortest paths using Johnson’s algorithm.
- **`inDegree()`** : Returns the in-degree of a node in a directed graph.
- **`isAcyclic()`** : Determines whether a directed graph is acyclic (DAG).
- **`isBiconnected()`** : Determines whether an undirected graph is biconnected.
- **`isConnected()`** : Checks whether an undirected graph is fully connected.
- **`isDirected`()`** : Determines whether a graph is directed by checking edge symmetry.
- **`isEmpty()`** : Checks whether a graph contains no nodes or no edges.
- **`isForest()`** : Determines whether an undirected graph is a forest.
- **`isStronglyConnected()`** : Checks whether a directed graph is strongly connected.
- **`isTree()`** : Determines whether an undirected graph is a tree.
- **`isUndirected()`** : Determines whether a graph is undirected by verifying edge symmetry.
- **`isWeaklyConnected()`** : Checks whether a directed graph is weakly connected.
- **`kCore()`** : Computes the k-core of an undirected graph.
- **`kosarajuSCC()`** : Finds all strongly connected components using Kosaraju’s two‑pass algorithm.
- **`kruskal()`** : Computes a Minimum Spanning Tree (MST) using Kruskal’s algorithm.
- **`kTruss()`** : Computes the k-truss subgraph of an undirected graph.
- **`laplacian()`** : Constructs the combinatorial Laplacian matrix L = D − A of an undirected graph.
- **`localClustering()`** : Computes the local clustering coefficient of a given vertex.
- **`maximalCliques()`** : Enumerates all maximal cliques of an undirected graph.
- **`mutuallyReachable()`** : Checks whether two nodes are mutually reachable in a directed graph.
- **`nodeCount()`** : Returns the total number of nodes in the graph.
- **`nodeRemovalImpact()`** : Computes the structural impact of removing each vertex from the graph.
- **`outDegree()`** : Returns the out-degree of a node in a directed graph.
- **`prim()`** : Computes a Minimum Spanning Tree (MST) using Prim’s algorithm.
- **`radius()`** : Computes the radius of an undirected graph.
- **`reachableFrom()`** : Returns all nodes reachable from a given source in a directed graph.
- **`sccCount()`** : Returns the number of strongly connected components (SCCs) in a directed graph.
- **`sccOf()`** : Returns the strongly connected component (SCC) containing the specified node.
- **`spectralRadius()`** : Computes the spectral radius ρ(A) of the adjacency matrix of an undirected graph.
- **`tarjanSCC()`** : Finds all strongly connected components in a directed graph using Tarjan’s algorithm.
- **`topologicalSort()`** : Computes a topological ordering of a directed acyclic graph (DAG).
- **`topologicalSortCondensation()`** : Computes a topological ordering of the condensation graph (SCC DAG).
- **`transitivity()`** : Computes the transitivity of an undirected graph.
- **`transpose()`** : Computes the transpose of a directed graph by reversing all edges.
- **`triangleCount()`** : Counts the number of triangles in an undirected graph.
- **`trussDecomposition()`** : Computes the full truss decomposition of an undirected graph.
- **`vertexConnectivity()`** : Computes the vertex connectivity κ(G) of an undirected graph.
- **`weaklyConnectedComponents()`** : Finds all weakly connected components in a directed graph.


---
